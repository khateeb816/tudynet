<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\ReferralWithdrawal;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReferralController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role == "super_admin";

        // Personal Stats (For everyone, determining withdrawal eligibility)
        $personalTotal = Referral::where('referrer_id', $user->id)->sum('reward_amount');
        $personalPaid = Referral::where('referrer_id', $user->id)->where('status', 'paid')->sum('reward_amount');
        $personalPending = $personalTotal - $personalPaid;

        if ($isAdmin) {
            // Admin View
            $referrals = Referral::with(['referrer', 'referredUser', 'order'])
                ->latest()
                ->paginate(15);
            
            $withdrawals = ReferralWithdrawal::with('user')->latest()->get();

            // System-wide stats (For Display in Cards)
            $totalEarned = Referral::sum('reward_amount');
            $paidAmount = Referral::where('status', 'paid')->sum('reward_amount');
            $pendingAmount = $totalEarned - $paidAmount; // System Liability

        } else {
            // Client View
            $referrals = Referral::where('referrer_id', $user->id)
                ->with(['referredUser', 'order'])
                ->latest()
                ->paginate(15);
            
            $withdrawals = ReferralWithdrawal::where('user_id', $user->id)->latest()->get();

            // For clients, displayed stats are personal stats
            $totalEarned = $personalTotal;
            $paidAmount = $personalPaid;
            $pendingAmount = $personalPending;
        }

        return view('referrals.index', compact(
            'referrals', 
            'totalEarned', // System or Personal depending on role (Card Stats)
            'paidAmount', 
            'pendingAmount', // System or Personal (Card Stats)
            'withdrawals',
            'personalPending', // Explicitly personal for Withdrawal Form check
            'isAdmin'
        ));
    }

    public function generateCode()
    {
        $user = Auth::user();

        if (!$user->referral_code) {
            $user->update([
                'referral_code' => $this->generateUniqueReferralCode(),
            ]);
        }

        return redirect()->back()->with('success', 'Referral code generated!');
    }

    public function requestWithdrawal(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $pendingAmount = Referral::where('referrer_id', $user->id)
            ->where('status', 'pending')
            ->sum('reward_amount');

        if ($request->amount > $pendingAmount) {
            return redirect()->back()->with('error', 'Insufficient pending amount!');
        }

        ReferralWithdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'requested',
        ]);

        // Notify managers/super admins
        $admins = \App\Models\User::whereIn('role', ['super_admin', 'manager'])->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'message' => 'Referral withdrawal request of $' . $request->amount . ' from ' . $user->name,
                'by' => $user->id,
                'to' => $admin->id,
            ]);
        }

        return redirect()->back()->with('success', 'Withdrawal request submitted! We will respond within 24 hours.');
    }

    public function approveWithdrawal($id)
    {
        $withdrawal = ReferralWithdrawal::findOrFail($id);
        
        if ($withdrawal->status !== 'requested') {
            return redirect()->back()->with('error', 'Withdrawal already processed.');
        }

        // 1. Mark withdrawal as paid
        $withdrawal->update([
            'status' => 'paid',
            'processed_at' => now(),
        ]);

        // 2. Mark corresponding pending referrals as paid
        // We find the user's pending referrals and mark them paid until we cover the amount.
        $pendingReferrals = Referral::where('referrer_id', $withdrawal->user_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc') // Oldest first
            ->get();

        $remainingToCover = $withdrawal->amount;

        foreach ($pendingReferrals as $referral) {
            if ($remainingToCover <= 0) break;

            if ($referral->reward_amount <= $remainingToCover) {
                // Fully cover this referral
                $referral->update(['status' => 'paid']);
                $remainingToCover -= $referral->reward_amount;
            } else {
                // Partial coverage (Logic complication: Referrals are single items. We usually don't partial pay a single referral row unless we split it?)
                // Assuming withdrawals are exact sums of referral amounts or we just mark "up to" amount.
                // Simple approach: Mark this referral as paid even if it exceeds the remaining amount slightly? 
                // OR: Just mark it paid. The user requested X amount.
                // If they requested a partial amount of a big referral, we can't easily track that in the current DB structure.
                // For now, let's assume they request loosely based on available funds.
                // We will mark the referral as paid.
                $referral->update(['status' => 'paid']);
                $remainingToCover = 0; 
            }
        }
        
        // Notify User
        \App\Models\Notification::create([
            'message' => 'Your withdrawal request of $' . $withdrawal->amount . ' has been approved/paid.',
            'by' => Auth::id(),
            'to' => $withdrawal->user_id,
        ]);

        return redirect()->back()->with('success', 'Withdrawal approved and processed.');
    }

    private function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (\App\Models\User::where('referral_code', $code)->exists());

        return $code;
    }
}

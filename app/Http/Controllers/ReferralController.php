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

        $referrals = Referral::where('referrer_id', $user->id)
            ->with(['referredUser', 'order'])
            ->latest()
            ->paginate(15);

        $totalEarned = Referral::where('referrer_id', $user->id)->sum('reward_amount');
        $paidAmount = Referral::where('referrer_id', $user->id)->where('status', 'paid')->sum('reward_amount');
        $pendingAmount = $totalEarned - $paidAmount;

        $withdrawals = ReferralWithdrawal::where('user_id', $user->id)->latest()->get();

        return view('referrals.index', compact('referrals', 'totalEarned', 'paidAmount', 'pendingAmount', 'withdrawals'));
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

        // Notify super admin
        $superAdmins = \App\Models\User::where('role', 'super_admin')->get();
        foreach ($superAdmins as $admin) {
            \App\Models\Notification::create([
                'message' => 'Referral withdrawal request of $' . $request->amount . ' from ' . $user->name,
                'by' => $user->id,
                'to' => $admin->id,
            ]);
        }

        return redirect()->back()->with('success', 'Withdrawal request submitted! We will respond within 24 hours.');
    }

    private function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (\App\Models\User::where('referral_code', $code)->exists());

        return $code;
    }
}

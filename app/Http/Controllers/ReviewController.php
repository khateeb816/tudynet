<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'comment' => 'required|string',
        ]);

        Review::create([
            'order_id' => $request->order_id,
            'comment' => $request->comment,
            'created_by' => Auth::id(),
        ]);

        // Check for meeting request
        if (trim($request->comment) === 'I would like to request a meeting regarding this order.') {
            $managers = \App\Models\User::whereIn('role', ['manager', 'super_admin'])->get();
            $emails = $managers->pluck('email')->filter()->toArray();
            
            if (!empty($emails)) {
                $orderId = $request->order_id;
                $user = Auth::user();
                $subject = "Meeting Request for Order #{$orderId}";
                $content = "User {$user->name} (ID: {$user->id}) has requested a meeting regarding Order #{$orderId}.";
                
                \App\Helpers\MailHelper::send($emails, $subject, $content);
            }
        }

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}

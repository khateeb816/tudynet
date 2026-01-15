<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{

    public function request(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = \App\Models\Order::findOrFail($request->order_id);

        if ($order->created_by !== Auth::id()) {
            abort(403);
        }

        $meeting = Meeting::create([
            'order_id' => $request->order_id,
            'requested_by' => Auth::id(),
            'status' => 'requested',
        ]);

        // Notify managers and super admins
        $managers = \App\Models\User::whereIn('role', ['manager', 'super_admin'])->get();

        foreach ($managers as $manager) {
            Notification::create([
                'order_id' => $order->id,
                'message' => 'Meeting requested for order #' . $order->id,
                'by' => Auth::id(),
                'to' => $manager->id,
            ]);
        }

        return redirect()->back()->with('success', 'Meeting request submitted! We will respond within 24 hours.');
    }
}

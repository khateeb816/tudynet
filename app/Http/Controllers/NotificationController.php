<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $query = Notification::where(function ($q) {
                $q->where('to', Auth::id())
                  ->orWhere('to_role', Auth::user()->role);
            })
            ->with(['order', 'createdBy'])
            ->latest();

        if ($request->has('keyword')) {
            $query->where('message', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->where('is_read', true);
            } else {
                $query->where('is_read', false);
            }
        }

        $notifications = $query->paginate(20);

        Notification::where(function ($q) {
                $q->where('to', Auth::id())
                  ->orWhere('to_role', Auth::user()->role);
            })
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->to !== Auth::id() && $notification->to_role !== Auth::user()->role) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead()
    {
        Notification::where(function ($q) {
                $q->where('to', Auth::id())
                  ->orWhere('to_role', Auth::user()->role);
            })
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->isSuperAdmin() || $user->isManager()) {
            $data['totalOrders'] = Order::count();
            $data['pendingOrders'] = Order::where('status', 'pending')->count();
            $data['approvedOrders'] = Order::where('status', 'approved')->count();
            $data['completedOrders'] = Order::where('status', 'completed')->count();
            $data['recentOrders'] = Order::with(['creator', 'subject'])->latest()->take(10)->get();
        } elseif ($user->isWriter()) {
            $data['assignedOrders'] = Order::where('assigned_to', $user->id)->count();
            $data['completedOrders'] = Order::where('assigned_to', $user->id)->where('status', 'completed')->count();
            $data['myOrders'] = Order::where('assigned_to', $user->id)->with(['creator', 'subject'])->latest()->take(10)->get();
        } else {
            $data['myOrders'] = Order::where('created_by', $user->id)->with(['subject', 'assignedWriter'])->latest()->take(10)->get();
            $data['totalOrders'] = Order::where('created_by', $user->id)->count();
        }

        $data['unreadNotifications'] = Notification::where('to', $user->id)
            ->where('is_read', false)
            ->count();

        return view('dashboard', $data);
    }
}

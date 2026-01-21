<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function home()
    {
        return view('home.index');
    }
    
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

            // Prepare graph data
            // 1. Monthly Orders (Last 6 months)
            $sixMonthsAgo = now()->subMonths(5)->startOfMonth();
            $monthlyOrdersData = Order::select('id', 'created_at')
                ->where('created_at', '>=', $sixMonthsAgo)
                ->get()
                ->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->created_at)->format('M Y');
                });
            
            $months = [];
            $monthlyCounts = [];
            
            // Fill in the last 6 months to ensure continuity even if 0
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthName = $date->format('M Y');
                $months[] = $monthName;
                $monthlyCounts[] = isset($monthlyOrdersData[$monthName]) ? $monthlyOrdersData[$monthName]->count() : 0;
            }
            
            $data['graphMonths'] = $months;
            $data['graphMonthlyCounts'] = $monthlyCounts;

            // 2. Status Distribution
            $statusCounts = Order::selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->all();
            
            $allStatuses = ['pending', 'approved', 'completed', 'assigned', 'revision_requested']; // Add other statuses as needed
            $graphStatusCounts = [];
            $graphStatusLabels = [];
            
            foreach($statusCounts as $status => $count) {
                // Format label: "revision_requested" -> "Revision Requested"
                $graphStatusLabels[] = ucfirst(str_replace('_', ' ', $status));
                $graphStatusCounts[] = $count;
            }
            
            $data['graphStatusLabels'] = $graphStatusLabels;
            $data['graphStatusCounts'] = $graphStatusCounts;

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

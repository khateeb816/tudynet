@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <h2>{{ $totalOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Pending Orders</h5>
                <h2>{{ $pendingOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Approved Orders</h5>
                <h2>{{ $approvedOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Completed Orders</h5>
                <h2>{{ $completedOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    @elseif(auth()->user()->isWriter())
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Assigned Orders</h5>
                <h2>{{ $assignedOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Completed Orders</h5>
                <h2>{{ $completedOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-6">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">My Orders</h5>
                <h2>{{ $totalOrders ?? 0 }}</h2>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="table-container">
    <h5 class="mb-3">Recent Orders</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Words</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($recentOrders ?? $myOrders ?? []) as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->subject->name ?? 'N/A' }}</td>
                    <td>{{ $order->words }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


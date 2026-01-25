@extends('layouts.app')

@section('page-title', 'Orders')

@section('content')
<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Orders</h5>
        @if(auth()->user()->isClient())
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
        @endif
    </div>

    <div class="mb-3">
        <form method="GET" action="{{ route('orders.index') }}" class="row g-3">
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="assigned_to_writer" {{ request('status') == 'assigned_to_writer' ? 'selected' : '' }}>Assigned</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
    </div>

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
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->subject->name ?? 'N/A' }}</td>
                    <td>{{ $order->words }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge rounded-pill bg-{{ $order->status === 'cancelled' ? 'danger' : ($order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info')) }} px-3 py-2 text-uppercase">
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

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection


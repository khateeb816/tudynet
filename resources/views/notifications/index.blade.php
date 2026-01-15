@extends('layouts.app')

@section('page-title', 'Notifications')

@section('content')
<div class="table-container">
    <h5 class="mb-3">Notifications</h5>
    
    <form method="GET" action="{{ route('notifications.index') }}" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" name="keyword" placeholder="Keyword" value="{{ request('keyword') }}">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="order_id" placeholder="Order ID" value="{{ request('order_id') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">All</option>
                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
            </select>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </form>

    <div class="list-group">
        @forelse($notifications as $notification)
        <div class="list-group-item {{ !$notification->is_read ? 'bg-light' : '' }}">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ $notification->message }}</h6>
                    <small class="text-muted">
                        Order ID: {{ $notification->order_id ?? 'N/A' }} | 
                        {{ $notification->created_at->format('Y-m-d H:i:s') }}
                    </small>
                </div>
                @if(!$notification->is_read)
                <span class="badge bg-primary rounded-pill">New</span>
                @endif
            </div>
        </div>
        @empty
        <div class="alert alert-info">No notifications found</div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
@endsection


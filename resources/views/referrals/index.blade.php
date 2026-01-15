@extends('layouts.app')

@section('page-title', 'Referrals')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Earned</h5>
                <h2>${{ number_format($totalEarned, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Paid Amount</h5>
                <h2>${{ number_format($paidAmount, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Pending Amount</h5>
                <h2>${{ number_format($pendingAmount, 2) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="table-container mb-3">
    <h5 class="mb-3">My Referral Code</h5>
    @if(auth()->user()->referral_code)
    <div class="alert alert-info">
        <strong>Your Referral Code:</strong> {{ auth()->user()->referral_code }}
        <br>
        <strong>Referral URL:</strong> {{ url('/register?ref=' . auth()->user()->referral_code) }}
    </div>
    @else
    <form method="POST" action="{{ route('referrals.generate-code') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Generate Referral Code</button>
    </form>
    @endif
</div>

@if($pendingAmount > 0)
<div class="table-container mb-3">
    <h5 class="mb-3">Request Withdrawal</h5>
    <form method="POST" action="{{ route('referrals.request-withdrawal') }}">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (Max: ${{ number_format($pendingAmount, 2) }})</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" max="{{ $pendingAmount }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Request Withdrawal</button>
    </form>
</div>
@endif

<div class="table-container mb-3">
    <h5 class="mb-3">Referral History</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Referred User</th>
                    <th>Order ID</th>
                    <th>Reward Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($referrals as $referral)
                <tr>
                    <td>{{ $referral->referredUser->name }}</td>
                    <td>{{ $referral->order_id }}</td>
                    <td>${{ number_format($referral->reward_amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $referral->status === 'paid' ? 'success' : 'warning' }}">
                            {{ ucfirst($referral->status) }}
                        </span>
                    </td>
                    <td>{{ $referral->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No referrals found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $referrals->links() }}
</div>

<div class="table-container">
    <h5 class="mb-3">Withdrawal History</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Processed At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $withdrawal)
                <tr>
                    <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $withdrawal->status === 'paid' ? 'success' : ($withdrawal->status === 'requested' ? 'warning' : 'danger') }}">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </td>
                    <td>{{ $withdrawal->requested_at->format('M d, Y') }}</td>
                    <td>{{ $withdrawal->processed_at ? $withdrawal->processed_at->format('M d, Y') : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No withdrawals found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


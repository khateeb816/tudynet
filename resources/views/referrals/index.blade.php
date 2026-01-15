@extends('layouts.app')

@section('page-title', 'Referrals')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">{{ $isAdmin ? 'System Total Rewards' : 'Total Earned' }}</h5>
                <h2>${{ number_format($totalEarned, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">{{ $isAdmin ? 'System Total Paid' : 'Paid Amount' }}</h5>
                <h2>${{ number_format($paidAmount, 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">{{ $isAdmin ? 'System Pending Liability' : 'Pending Amount' }}</h5>
                <h2>${{ number_format($pendingAmount, 2) }}</h2>
            </div>
        </div>
    </div>
</div>
@if(!$isAdmin)
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
@endif
@if($personalPending > 0)
<div class="table-container mb-3">
    <h5 class="mb-3">Request Withdrawal</h5>
    <form method="POST" action="{{ route('referrals.request-withdrawal') }}">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (Max: ${{ number_format($personalPending, 2) }})</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" max="{{ $personalPending }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Request Withdrawal</button>
    </form>
</div>
@endif

<div class="table-container mb-3">
    <h5 class="mb-3">{{ (auth()->user()->role == "super_admin") ? 'All Referrals' : 'Referral History' }}</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    @if(auth()->user()->role == "super_admin")
                        <th>Referrer</th>
                    @endif
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
                    @if(auth()->user()->role == "super_admin")
                        <td>
                            <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#userDetailsModal" data-name="{{ $referral->referrer->name }}" data-email="{{ $referral->referrer->email }}">
                                {{ $referral->referrer->name }}
                            </a>
                        </td>
                    @endif
                    <td>
                        <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#userDetailsModal" data-name="{{ $referral->referredUser->name }}" data-email="{{ $referral->referredUser->email }}">
                            {{ $referral->referredUser->name }}
                        </a>
                    </td>
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
                    <td colspan="{{ (auth()->user()->role == "super_admin") ? 6 : 5 }}" class="text-center">No referrals found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $referrals->links() }}
</div>

<div class="table-container">
    <h5 class="mb-3">{{ (auth()->user()->role == "super_admin") ? 'Withdrawal Requests' : 'Withdrawal History' }}</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    @if(auth()->user()->role == "super_admin")
                        <th>User</th>
                    @endif
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Processed At</th>
                    @if(auth()->user()->isManager() || auth()->user()->isSuperAdmin())
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $withdrawal)
                <tr>
                    @if(auth()->user()->role == "super_admin")
                        <!-- Admin View: User Name -->
                        <td>
                            <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#userDetailsModal" data-name="{{ $withdrawal->user->name }}" data-email="{{ $withdrawal->user->email }}">
                                {{ $withdrawal->user->name }}
                            </a>
                        </td>
                    @endif
                    <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $withdrawal->status === 'paid' ? 'success' : ($withdrawal->status === 'requested' ? 'warning' : 'danger') }}">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </td>
                    <td>{{ $withdrawal->requested_at->format('M d, Y') }}</td>
                    <td>{{ $withdrawal->processed_at ? $withdrawal->processed_at->format('M d, Y') : 'N/A' }}</td>
                    @if(auth()->user()->role == "super_admin")
                        <td>
                            @if($withdrawal->status === 'requested')
                                <form action="{{ route('referrals.withdrawals.approve', $withdrawal->id) }}" method="POST" onsubmit="return confirm('Approve this withdrawal?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ (auth()->user()->role == "super_admin") ? 6 : 4 }}" class="text-center">No withdrawals found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Admin: All Referrals Table Logic Update --}}
@if(auth()->user()->role == "super_admin")
    {{-- Since we use the same $referrals variable, but with distinct data --}}
    {{-- We should modify the specific table HEADERS for admin vs client --}}
    <!-- We missed modifying the Referrals Table Headers/Body for Admin earlier in this file. 
         Ideally, we'd have two separate table blocks or conditional columns. 
         Let's just update the Table Headers/Body above via a second tool call or careful replacement? 
         This tool call targeted the Withdrawals table bottom. 
         The Referrals table is ABOVE. I will handle this in a separate chunk to be safe or try to do it here.
    -->
@endif
        </table>
    </div>
</div>
@endsection

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle display-1 text-primary"></i>
                </div>
                <h4 id="modalUserName" class="mb-1"></h4>
                <p id="modalUserEmail" class="text-muted"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var userDetailsModal = document.getElementById('userDetailsModal');
        userDetailsModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');
            
            var modalTitle = userDetailsModal.querySelector('.modal-title');
            var modalName = userDetailsModal.querySelector('#modalUserName');
            var modalEmail = userDetailsModal.querySelector('#modalUserEmail');
            
            modalName.textContent = name;
            modalEmail.textContent = email;
        });
    });
</script>
@endsection


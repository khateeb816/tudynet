@extends('layouts.app')

@section('page-title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="table-container">
            <h5 class="mb-3">Profile Information</h5>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" value="{{ ucfirst(str_replace('_', ' ', $user->role)) }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" value="{{ ucfirst($user->status) }}" disabled>
                </div>

                @if($user->referral_code)
                <div class="mb-3">
                    <label for="referral_code" class="form-label">Referral Code</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="referral_code" value="{{ $user->referral_code }}" readonly>
                        <button type="button" class="btn btn-outline-secondary" onclick="copyReferralCode()">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    </div>
                    <small class="text-muted">Share this code with others to earn referral rewards!</small>
                </div>
                @endif

                <hr class="my-4">
                <h6 class="mb-3">Change Password</h6>
                <p class="text-muted">Leave blank if you don't want to change your password.</p>

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="table-container">
            <h5 class="mb-3">Account Statistics</h5>

            @if($user->isClient())
            <div class="mb-3">
                <strong>Total Orders:</strong> {{ $user->orders()->count() }}
            </div>
            @endif

            @if($user->isWriter())
            <div class="mb-3">
                <strong>Assigned Orders:</strong> {{ $user->assignedOrders()->count() }}
            </div>
            <div class="mb-3">
                <strong>Completed Orders:</strong> {{ $user->assignedOrders()->where('status', 'completed')->count() }}
            </div>
            @endif

            @if($user->referral_code)
            <div class="mb-3">
                <strong>Total Referrals:</strong> {{ $user->referralRewards()->count() }}
            </div>
            <div class="mb-3">
                <strong>Total Earned:</strong> ${{ number_format($user->referralRewards()->sum('reward_amount'), 2) }}
            </div>
            @endif

            <div class="mb-3">
                <strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}
            </div>
        </div>
    </div>
</div>

@if($user->referral_code)
@section('scripts')
<script>
function copyReferralCode() {
    const referralCode = document.getElementById('referral_code');
    referralCode.select();
    referralCode.setSelectionRange(0, 99999); // For mobile devices
    navigator.clipboard.writeText(referralCode.value);
    alert('Referral code copied to clipboard!');
}
</script>
@endsection
@endif
@endsection


@extends('layouts.guest')

@section('title', 'Register - Tudynet')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 auth-wrapper">
        <!-- Left Side -->
        <div class="col-lg-7 d-none d-lg-flex flex-column justify-content-center p-5 auth-left">
            <div class="wave-bg"></div>
            <div class="position-relative" style="z-index: 1; max-width: 90%; margin: 0 auto;">
                <div class="mb-4">
                    <div class="d-flex flex-column align-items-center mb-4">
                        <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Tudynet Logo" style="height: 80px; object-fit: contain;" class="mb-2">
                        <h2 class="fw-bold text-dark m-0">Tudy<span style="color: #8B0000;">net</span></h2>
                        <span class="small fw-bold border border-dark px-1 rounded mt-1">Management System</span>
                    </div>
                </div>
                
                <h1 class="fw-bold mb-3 display-6">Order & Referral Management System</h1>
                <h3 class="h4 text-muted mb-4">Streamlining Academic & Professional Writing Services</h3>
                
                <p class="mb-5 text-secondary" style="line-height: 1.6;">
                    Tudynet provides a comprehensive platform for managing writing orders, connecting clients with expert writers, and facilitating a seamless referral system. Experience efficient workflow management, real-time updates, and secure payment processing.
                </p>
                
                <h5 class="fw-bold mb-3">Key Features</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Live Order Tracking</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Secure Payments</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Revision Requests</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Referral Rewards</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Direct Communication</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Detailed Analytics</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-lg-5 auth-right d-flex align-items-center justify-content-center p-5">
            <div class="w-100" style="max-width: 450px;">
                <h3 class="fw-bold mb-2">Create Client Account</h3>
                <p class="text-muted mb-5 small">Join TudyNet Management System today.</p>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                                        
                    <div class="mb-3">
                        <label for="name" class="form-label text-muted small fw-bold">Full Name</label>
                        <input type="text" class="form-control p-3 bg-light border-0" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted small fw-bold">Email</label>
                        <input type="email" class="form-control p-3 bg-light border-0" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label text-muted small fw-bold">Password</label>
                        <input type="password" class="form-control p-3 bg-light border-0" id="password" name="password" placeholder="Min. 8 characters" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-muted small fw-bold">Confirm Password</label>
                        <input type="password" class="form-control p-3 bg-light border-0" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <div class="mb-4">
                        <label for="referral_code" class="form-label text-muted small fw-bold">Referral Code (Optional)</label>
                        <input type="text" class="form-control p-3 bg-light border-0" id="referral_code" name="referral_code" value="{{ old('referral_code') }}" placeholder="Referral Code">
                    </div>
                    
                    <button type="submit" class="btn btn-tudynet mb-4">Register</button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Already have an account?</span>
                        <a href="{{ route('login') }}" style="color: #8B0000;" class="text-decoration-none small fw-bold ms-1">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.guest')

@section('title', 'Login - Studynet')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 auth-wrapper">
        <!-- Left Side -->
        <div class="col-lg-7 d-none d-lg-flex flex-column justify-content-center p-5 auth-left">
            <div class="wave-bg"></div>
            <div class="position-relative" style="z-index: 1; max-width: 90%; margin: 0 auto;">
                <div class="mb-4">
                    <!-- Text Logo based on image since we might not have the image file -->
                    <div class="d-flex flex-column align-items-center mb-4">
                         <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Studynet Logo" style="height: 80px; object-fit: contain;" class="mb-2">
                        <h2 class="fw-bold text-dark m-0">Study<span style="color: #8B0000;">net</span></h2>
                        <span class="small fw-bold border border-dark px-1 rounded mt-1">Management System</span>
                    </div>
                </div>
                
                <h1 class="fw-bold mb-3 display-6">Order & Referral Management System</h1>
                <h3 class="h4 text-muted mb-4">Streamlining Academic & Professional Writing Services</h3>
                
                <p class="mb-5 text-secondary" style="line-height: 1.6;">
                    Studynet provides a comprehensive platform for managing writing orders, connecting clients with expert writers, and facilitating a seamless referral system. Experience efficient workflow management, real-time updates, and secure payment processing.
                </p>
                
                <h5 class="fw-bold mb-3">Key Features</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Order Management: Track deadlines & progress.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Referral System: Earn through our network.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Secure Payments: Verify & process instantly.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Role-Based Access: Clients, Writers, Managers.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Real-time Notifications: Stay updated on order status.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: #8B0000;"></i> Quality Assurance: Feedback & revision loops.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-lg-5 auth-right d-flex align-items-center justify-content-center p-5">
            <div class="w-100" style="max-width: 450px;">
                <h3 class="fw-bold mb-2">Welcome to Studynet</h3>
                <p class="text-muted mb-5 small">Your Academic Writing Management Solution</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted small fw-bold">Email</label>
                        <input type="email" class="form-control p-3 bg-light border-0" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-2">
                        <label for="password" class="form-label text-muted small fw-bold">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control p-3 bg-light border-0" id="password" name="password" placeholder="Password" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted cursor-pointer">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end mb-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color: #8B0000;" class="text-decoration-none small fw-bold">Forgot Password?</a>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-studynet mb-4">Login</button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Don't have an account?</span>
                        <a href="{{ route('register') }}" style="color: #8B0000;" class="text-decoration-none small fw-bold ms-1">Signup as Client</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


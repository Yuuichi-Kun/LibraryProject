@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Create Account 🚀</h2>
                <p class="text-muted">Get started with your free account</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label text-muted">Full Name</label>
                            <input id="name" type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   placeholder="Enter your full name"
                                   required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-muted">Email Address</label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email"
                                   required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-muted">Password</label>
                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Create a password"
                                   required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label text-muted">Confirm Password</label>
                            <input id="password-confirm" type="password" 
                                   class="form-control form-control-lg" 
                                   name="password_confirmation" 
                                   placeholder="Confirm your password"
                                   required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            Register
                        </button>

                        <p class="text-center mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

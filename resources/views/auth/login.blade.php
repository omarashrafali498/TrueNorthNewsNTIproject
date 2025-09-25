@extends('layouts.empty')
@section('title', 'Register')
@section('layout')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow align-items-center">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle display-1 text-primary"></i>
                        <h2 class="mt-2 mb-3">Sign In</h2>
                        <p class="text-muted">Enter your credentials to access your account</p>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('login.req') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                            </div>
                            <div class="form-text">
                                <a href="#" class="text-decoration-none">Forgot password?</a>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="action" value="login" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
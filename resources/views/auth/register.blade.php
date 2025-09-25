@extends('layouts.empty')
@section('title', 'Register')
@section('layout')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus display-1 text-primary"></i>
                        <h2 class="mt-2 mb-3">Create Account</h2>
                        <p class="text-muted">Fill in your details to create a new account</p>
                        <div class="mb-4">
                            {{-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p> --}}
                            {{-- @error('registerError')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                        </div>
                        @enderror --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <hr>
                </div>
                <form method="post" action="{{ route('register.req') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="John Doe">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control" name="phone" placeholder="(123) 456-7890">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Create password">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms">
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="action" value="register" class="btn btn-primary">Create Account</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
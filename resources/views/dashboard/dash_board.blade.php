@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
@push('styles')
<style>
    .welcome-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .welcome-content {
        background: white;
        border-radius: 15px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
        max-width: 800px;
        margin-top: 73px;
        margin-left: 295px;

    }

    .welcome-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        padding: 20px;
    }

    .welcome-title {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .welcome-subtitle {
        color: #718096;
        font-size: 1.2rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .feature-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }
</style>
@endpush

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="welcome-container">
        <div class="welcome-content text-center">
            <div class="welcome-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Welcome" class="img-fluid">
            </div>

            <h1 class="welcome-title">Welcome to Your Dashboard!</h1>
            <p class="welcome-subtitle">
                You're now logged in and ready to manage your account. <br>
                Here you can view important information and manage your settings.
            </p>

            <div class="feature-cards">
                <div class="feature-card text-left">
                    <h5><i class="fas fa-users mr-2"></i>User Management</h5>
                    <p class="mb-0">Manage user accounts and permissions</p>
                </div>
                <div class="feature-card text-left">
                    <h5><i class="fas fa-chart-bar mr-2"></i>Analytics</h5>
                    <p class="mb-0">View statistics and reports</p>
                </div>
                <div class="feature-card text-left">
                    <h5><i class="fas fa-cog mr-2"></i>Settings</h5>
                    <p class="mb-0">Configure your preferences</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
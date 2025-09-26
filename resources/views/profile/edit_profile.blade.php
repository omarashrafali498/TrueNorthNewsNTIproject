@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('title', 'Edit Profile')
@section('content')

<form method="post" enctype="multipart/form-data" action="{{ route('posts.profile.update') }}">
    @csrf
    @method('PUT')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <input type="hidden" name="action" value="update">
    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user-circle"></i> User Profile</h1>
            <p>Manage your personal information</p>
        </div>
        <div class="profile-content">
            <div class="profile-picture">
                <img src="{{ asset('uploads/photos/' . $user->photo) }}" alt="Profile Photo" id="profileImage">
                <input type="file" name="photo" id="uploadPhoto" accept="image/*">
                <label for="uploadPhoto"><i class="fas fa-camera"></i> Change Photo</label>
            </div>
            <div class="profile-info">
                <h2>Personal Information</h2>
                <div class="name-fields">
                    <div class="info-group">
                        <label for="firstName"><i class="fas fa-user"></i> Name</label>
                        <input type="text" name="name" id="firstName" required placeholder="Enter your name" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="info-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" id="email" required placeholder="Enter your email address" value="{{ $user->email }}">
                </div>
                <div class="info-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="tel" name="phone" id="phone" required placeholder="Enter your phone number" value="{{ $user->phone }}">
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-outline" onclick="window.location.href='index.php'">Cancel</button>
                    <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // Function to handle profile photo upload preview
    document.getElementById('uploadPhoto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
@extends('layouts.main')
@section('title', 'Home - TrueNorth News')
@section('content')
<div class="container mt-4">
    <h1 class="text-center">Welcome to TrueNorth News</h1>
    <p class="fs-4 text-body-secondary text-center mb-4">
        Your daily source of reliable news and insightful analysis.
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 display inline">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </p>
    <div class="row justify-content-center" id="articles">
        @foreach ($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://dummyimage.com/600x400/4a5568/ffffff&text=Blog+Post' }}" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">
                        {{ $post->content }}
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-info btn-sm">See Full Article</a>
                        <small class="text-body-secondary"> {{ $post->created_at->format('d M Y, h:i A') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
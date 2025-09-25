@extends('layouts.main')
@section('title', 'Edit Article')
@section('content')
<div class="container mt-4">
    <div class="article-form-container">
        <div class="form-header">
            <h2><i class="fas fa-plus-circle me-2"></i>Edit Article</h2>
            <p class="text-muted">Share your story with the world</p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 display inline">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Title -->
            <div class="form-section">
                <label for="title" class="form-label required-field">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Enter a compelling title" required maxlength="120" value="{{ $post->title }}" />
                <div class="form-text">Max 120 characters</div>
            </div>
            <!-- Content -->
            <div class="form-section">
                <label for="content" class="form-label required-field">Content</label>
                <textarea class="form-control" id="content" name="content" rows="8"
                    placeholder="Write your article content here..." required>{{ $post->content }}</textarea>

            </div>
            <!-- Category & Tags -->
            <div class="form-section">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Categories</label>
                        <select class="form-select" id="category" name="categories[]" multiple>
                            @foreach($allCategories as $category)
                            <option value="{{ $category->id }}"
                                {{ $post->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags"
                            placeholder="Separate tags with commas" value="{{ $post->tags->pluck('name')->implode(', ') }}" />
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="form-section">
                <label for="imageUpload" class="form-label">Article Image</label>
                <div class="image-upload-container">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <p>Upload your image below</p>
                    <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*" />
                    <div class="form-text">Supported: JPG, PNG, GIF </div>
                </div>
                @if($post->image)
                <p class="text-center">Current Image:</p>
                <div class="mt-3 d-flex justify-content-center">
                    <img class="align-center " src="{{ asset('storage/' . $post->image) }}" alt="Current Article Image" style="max-height: 200px;">
                </div>
                @endif
            </div>
            <!-- Options -->
            <div class="form-section">
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured" />
                    <label class="form-check-label" for="featured">Feature this article on homepage</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="comments" name="comments" checked />
                    <label class="form-check-label" for="comments">Allow comments</label>
                </div>
            </div>
            <!-- Buttons -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-secondary me-md-2" onclick="window.history.back();">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Update Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
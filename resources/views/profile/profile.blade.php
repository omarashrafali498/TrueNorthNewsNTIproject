@extends('layouts.main')
@section('title', 'Profile')
@section('content')

<div class="container mt-4 mb-5">
    <div class="profile-card">
        <!-- Profile Header -->

        <div class="profile-header">
            <img src="{{ asset('uploads/photos/' . $user->photo) }}" class="profile-avatar" />
            <h3>{{ $user->name }}</h3>
            <p class="mb-0">{{ $user->email }}</p>
            <p class="mb-0">Member since {{ $user->created_at->format('Y') }}</p>
        </div>
        <!-- Profile Stats -->
        <div class="profile-stats">
            <div class="stat-item">
                <p class="stat-number">{{ $articles_count }}</p>
                <p class="stat-label">Articles</p>
            </div>
        </div>
        <!-- Profile Content -->
        <div class="card-body">
            <h4 class="mb-4 text-center">Articles</h4>
            <table class="articles-table">
                <thead>
                    <tr>
                        <th class="text-center">Article Title</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Views</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td class="text-start">
                            {{ $post->title }}
                        </td>
                        <td class="text-center">{{ $post->created_at->format('M d, Y') }}</td>
                        <td class="text-center"><i
                                class="fas fa-eye"></i>{{ $post->views }} </td>
                        <td class="text-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-info btn-action"><i
                                    class="fas fa-eye"></i> View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary btn-action"><i
                                    class="fas fa-edit"></i> Edit</a>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-action deletePostBtn"
                                data-post-id="{{ $post->id }}"
                                data-post-title="{{ $post->title }}"
                                data-post-date="{{ $post->created_at->format('M d, Y') }}"
                                data-delete-url="{{ route('posts.destroy', $post->id) }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Profile Actions -->
            <div class="profile-actions mt-4">
                <a href="{{ route('posts.profile.edit', $user->id) }}" class="btn btn-outline-info">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Post Confirmation Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deletePostModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Post Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-file-times text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-danger mb-3">Are you absolutely sure?</h5>
                <p class="mb-2">You are about to permanently delete your post:</p>
                <div class="alert alert-light border">
                    <strong id="postToDeleteTitle"></strong><br>
                    <small class="text-muted">Created on <span id="postToDeleteDate"></span></small>
                </div>
                <div class="alert alert-warning border-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. Your post and all its comments will be permanently removed.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="button" id="confirmDeletePostBtn" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-1"></i>Yes, Delete Post
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for post deletion -->
<form id="deletePostForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('styles')
<style>
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        border-bottom: none;
        padding: 1.5rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem 2rem 2rem;
        background-color: #f8f9fa;
    }

    .deletePostBtn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        transition: all 0.2s ease;
    }

    .alert {
        border-radius: 10px;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
    }

    #confirmDeletePostBtn:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
    }

    .btn-action {
        margin: 0 2px;
        padding: 0.375rem 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Profile delete script loaded');

        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.deletePostBtn');
        const modal = document.getElementById('deletePostModal');
        const confirmDeleteBtn = document.getElementById('confirmDeletePostBtn');
        const postTitleElement = document.getElementById('postToDeleteTitle');
        const postDateElement = document.getElementById('postToDeleteDate');
        const deleteForm = document.getElementById('deletePostForm');

        let currentDeleteUrl = '';

        deleteButtons.forEach(function(button, index) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Delete button clicked');

                const postId = this.getAttribute('data-post-id');
                const postTitle = this.getAttribute('data-post-title');
                const postDate = this.getAttribute('data-post-date');
                const deleteUrl = this.getAttribute('data-delete-url');

                console.log('Post data:', {
                    postId,
                    postTitle,
                    postDate,
                    deleteUrl
                });

                // Store the delete URL
                currentDeleteUrl = deleteUrl;

                // Update modal content
                if (postTitleElement) postTitleElement.textContent = postTitle;
                if (postDateElement) postDateElement.textContent = postDate;

                // Show modal
                if (modal) {
                    try {
                        const bootstrapModal = new bootstrap.Modal(modal);
                        bootstrapModal.show();
                        console.log('Modal shown');
                    } catch (error) {
                        console.error('Error showing modal:', error);
                        // Fallback to basic confirm
                        if (confirm('Are you sure you want to delete "' + postTitle + '"?')) {
                            deleteForm.action = deleteUrl;
                            deleteForm.submit();
                        }
                    }
                }
            });
        });

        // Handle confirm delete
        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                if (currentDeleteUrl) {
                    // Show loading state
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Deleting...';
                    this.classList.add('disabled');

                    // Set form action and submit
                    deleteForm.action = currentDeleteUrl;
                    deleteForm.submit();
                }
            });
        }
    });
</script>
@endpush

@endsection
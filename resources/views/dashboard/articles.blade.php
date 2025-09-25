@extends('layouts.dashboard')
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

    .deleteArticleBtn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        transition: all 0.2s ease;
    }

    .alert {
        border-radius: 10px;
    }

    .btn {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }

    #confirmDeleteBtn:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
    }
</style>
@endpush
@section('title', 'Dashboard')
@section('content')
<div class="container ">
    <div class="table-container ">
        <div class="table-header">
            <h2>Article Management</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach ($posts as $post)
                    <tr data-user-id="{{ $post->id }}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger deleteArticleBtn"
                                data-article-id="{{ $post->id }}"
                                data-article-title="{{ $post->title }}"
                                data-article-author="{{ $post->user->name }}"
                                data-delete-url="{{ route('articles.delete', $post) }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Article Confirmation Modal -->
<div class="modal fade" id="deleteArticleModal" tabindex="-1" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteArticleModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Article Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-file-times text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-danger mb-3">Are you absolutely sure?</h5>
                <p class="mb-2">You are about to permanently delete this article:</p>
                <div class="alert alert-light border">
                    <strong id="articleToDeleteTitle"></strong><br>
                    <small class="text-muted">by <span id="articleToDeleteAuthor"></span></small>
                </div>
                <div class="alert alert-warning border-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. The article and all its comments will be permanently removed.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-1"></i>Yes, Delete Article
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.deleteArticleBtn');
        const modal = document.getElementById('deleteArticleModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const articleTitleElement = document.getElementById('articleToDeleteTitle');
        const articleAuthorElement = document.getElementById('articleToDeleteAuthor');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const articleId = this.getAttribute('data-article-id');
                const articleTitle = this.getAttribute('data-article-title');
                const articleAuthor = this.getAttribute('data-article-author');
                const deleteUrl = this.getAttribute('data-delete-url');

                // Update modal content
                articleTitleElement.textContent = articleTitle;
                articleAuthorElement.textContent = articleAuthor;
                confirmDeleteBtn.href = deleteUrl;

                // Show modal
                const bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();
            });
        });

        // Add loading state to confirm button
        confirmDeleteBtn.addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Deleting...';
            this.classList.add('disabled');
        });
    });
</script>
@endpush

@endsection
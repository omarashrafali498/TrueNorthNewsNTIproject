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

    .deleteUserBtn:hover {
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
            <h2>User Management</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach ($users as $user)
                    <tr data-user-id="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->photo }}" alt="Avatar" class="avatar"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger deleteUserBtn"
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}"
                                data-delete-url="{{ route('users.delete', $user) }}">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm User Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-user-times text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-danger mb-3">Are you absolutely sure?</h5>
                <p class="mb-2">You are about to permanently delete:</p>
                <div class="alert alert-light border">
                    <strong id="userToDeleteName"></strong><br>
                    <small class="text-muted" id="userToDeleteEmail"></small>
                </div>
                <div class="alert alert-warning border-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All user data will be permanently removed.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-1"></i>Yes, Delete User
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.deleteUserBtn');
        const modal = document.getElementById('deleteUserModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const userNameElement = document.getElementById('userToDeleteName');
        const userEmailElement = document.getElementById('userToDeleteEmail');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');
                const userEmail = this.getAttribute('data-user-email');
                const deleteUrl = this.getAttribute('data-delete-url');

                // Update modal content
                userNameElement.textContent = userName;
                userEmailElement.textContent = userEmail;
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
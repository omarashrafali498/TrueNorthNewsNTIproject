@extends('layouts.main')
@section('title', 'Full Article')
@section('content')
<!-- Main Content -->
<main class="container mt-4">
    <div class="article-container">
        <h1 class="text-center mb-4">{{ $post->title }}</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="article-content">
                    <p>
                        {{ $post->content }}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $post->image) }}" class="article-img" alt="Post Image">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="article-meta">
                    <div class="d-flex justify-content-between">
                        <div><strong>Author:</strong> {{ $post->user->name }}</div>
                        <div><strong>Published:</strong> {{ $post->created_at->format('F j, Y') }}</div>
                        <div><strong>Last updated:</strong> {{ $post->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments Section -->
        <div class="comments-section">
            <h3 class="mb-4"><i class="fas fa-comments me-2"></i> Comments ({{ $post->comments_count }})
            </h3>
            <!-- Comment Form -->
            <div class="comment-form">
                <h5 class="mb-3">Leave a comment</h5>
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="commentText" class="form-label">Comment</label>
                        <textarea class="form-control" id="commentText" name="comment_text" rows="3"
                            placeholder="Your comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-info">
                        Post Comment
                    </button>
                </form>
            </div>

            <div class="comment-list">
                @foreach($post->comments as $comment)
                <div class="card comment-card">
                    <div class="card-body">
                        <div class="comment-header">
                            <img src="{{ asset('uploads/photos/' . $comment->user->photo) }}"
                                alt="User avatar"
                                class="rounded-circle"
                                width="50"
                                height="50">
                            <div class="comment-meta">
                                <h6 class="comment-author">{{ $comment->user->name }}</h6>
                                <p class="comment-date">
                                    Posted on {{ $comment->created_at->format('F j, Y') }} at {{ $comment->created_at->format('g:i A') }}
                                </p>
                            </div>
                        </div>
                        <p class="card-text">
                            {{ $comment->comment_text }}
                        </p>
                        <div class="comment-actions">
                            <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $comment->likes->contains(auth()->id()) ? 'btn-danger' : 'btn-outline-primary' }}">
                                    <i class="fas fa-thumbs-up"></i>
                                    {{ $comment->likes->contains(auth()->id()) ? 'Unlike' : 'Like' }}
                                    ({{ $comment->likes()->count() }})
                                </button>
                            </form>
                            @if($comment->user_id === auth()->id())
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
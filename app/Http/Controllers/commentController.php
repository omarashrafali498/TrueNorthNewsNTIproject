<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $data = $request->validate([
            'comment_text' => 'required|string|max:1000', // use comment_text
        ]);

        Comment::create([
            'comment_text' => $data['comment_text'],
            'post_id' => $postId,
            'user_id' => auth()->id(),
        ]);
        

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $user = Auth::user();

        if ($comment->likes()->where('user_id', $user->id)->exists()) {
            $comment->likes()->detach($user->id);
            return redirect()->back()->with('success', 'Comment unliked.');
        } else {
            $comment->likes()->attach($user->id);
            return redirect()->back()->with('success', 'Comment liked.');
        }
    }
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->withErrors('You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}

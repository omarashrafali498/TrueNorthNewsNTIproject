<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create_article', compact('categories', 'tags'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('You must be logged in to create a post.');
        }

        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:8192',
            'tags'    => 'nullable|string', // single input string
        ]);
        // Create post
        $post = Post::create([
            'title'   => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(),
        ]);

        // Handle image
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
            $post->save();
        }


        // Handle hashtags
        if (!empty($data['tags'])) {
            // Split by #
            $hashtags = array_filter(array_map('trim', explode('#', $data['tags'])));

            foreach ($hashtags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $post->tags()->attach($tag->id);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Unique session key for this post view
        $key = 'post_' . $post->id . '_viewed';
        if (!session()->has($key)) {
            if (!auth()->check() || auth()->id() !== $post->user_id) {
                $post->increment('views');
            }
            session()->put($key, true);
        }

        $post->loadCount('comments')->load('comments.user', 'tags', 'categories', 'user');
        return view('posts.full_article', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        if (auth()->check() && auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->withErrors('You are not authorized to edit this post.');
        }
        $allCategories = Category::all();
        $allTags = Tag::all();
        return view('posts.edit_article', compact('post', 'allCategories', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if (auth()->check() && auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->withErrors('You are not authorized to update this post.');
        }

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|max:8192',
            'categories'  => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);
        $post->update([
            'title'   => $data['title'],
            'content' => $data['content'],
        ]);
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
            if ($post->image) {
                $post->save();
            } else {
                return back()->withErrors('Failed to upload image. size may be too large or invalid format.');
            }
        }

        $post->categories()->sync($request->input('categories', []));

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if (auth()->check() && auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index')->withErrors('You are not authorized to delete this post.');
        }
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.profile')->with('success', 'Post deleted successfully.');
    }
}

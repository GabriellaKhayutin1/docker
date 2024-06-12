<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    // Apply the auth middleware to all actions
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all(); // Retrieve all posts
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Log::info('Validated data:', $validatedData);

        try {
            $post = Post::create($validatedData);
            Log::info('Post created:', $post->toArray());
        } catch (\Exception $e) {
            Log::error('Error creating post:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Error creating post');
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Log::info('Update method called');
        Log::info('Request data:', $request->all());
        Log::info('Validated data:', [$validatedData]);

        try {
            $post->update($validatedData);
            Log::info('Post updated:', [$post->toArray()]);
        } catch (\Exception $e) {
            Log::error('Error updating post:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Error updating post');
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            Log::info('Post deleted:', [$post->toArray()]);
        } catch (\Exception $e) {
            Log::error('Error deleting post:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Error deleting post');
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

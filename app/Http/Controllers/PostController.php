<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latestList(),
        ]);
    }

    public function store(CreateRequest $request)
    {
        Post::createForUser(
            Auth::id(),
            $request->body
        );

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->updateBody($request->body);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->deletePost();

        return redirect()->route('posts.index');
    }
}

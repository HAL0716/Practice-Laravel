<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::latestList(),
        ]);
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        ['body' => $body] = $request->validated();

        Post::createForUser(
            Auth::id(),
            $body,
        );

        return redirect()->route('posts.index');
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        ['body' => $body] = $request->validated();

        $post->updateBody($body);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->deletePost();

        return redirect()->route('posts.index');
    }
}

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
        $this->authorize('viewAny', Post::class);

        return view('posts.index', [
            'posts' => Post::latestList()->get(),
        ]);
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        ['body' => $body] = $request->validated();

        Post::create([
            'user_id' => Auth::id(),
            'body' => $body,
        ]);

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

        $post->update($request->validated());

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index');
    }
}

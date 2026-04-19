<x-app-layout>
    <div class="bg-white shadow-sm rounded-lg p-4">
        @include('posts.partials.post-form', [
            'action' => route('posts.update', $post),
            'method' => 'PUT',
            'post' => $post,
            'title' => '投稿を編集',
            'button' => '更新'
        ])
    </div>
</x-app-layout>

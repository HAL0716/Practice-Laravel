<x-app-layout>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        @include('posts.partials.post-form', [
            'action' => route('posts.update', $post),
            'method' => 'PUT',
            'post' => $post,
            'title' => '投稿を編集',
            'button' => '更新'
        ])
    </div>
</x-app-layout>

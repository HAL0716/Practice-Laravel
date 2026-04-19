<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 space-y-4">

        <div class="bg-white shadow-sm rounded-lg p-4">
            @include('posts.partials.post-form', [
                'action' => route('posts.store'),
                'title' => '新規投稿',
                'button' => '送信'
            ])
        </div>

        @foreach($posts as $post)
            <div class="bg-white shadow-sm rounded-lg p-4">
                @include('posts.partials.post-card', [
                    'post' => $post
                ])
            </div>
        @endforeach
    </div>
</x-app-layout>

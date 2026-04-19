<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        @foreach($posts as $post)
            <div>
                {{ $post->user_name ?? $post->user?->name ?? '匿名' }} : {{ $post->body }}
            </div>
        @endforeach

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="text" name="body" required>
            <button type="submit">送信</button>
        </form>
    </div>
</x-app-layout>

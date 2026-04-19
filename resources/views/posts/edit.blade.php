<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            <input type="text" name="body" value="{{ old('body', $post->body) }}" required>
            <button type="submit">更新</button>
        </form>
    </div>
</x-app-layout>

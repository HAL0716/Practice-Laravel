<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            <x-input-label for="body" value="投稿内容" />
            <input id="body" type="text" name="body" value="{{ old('body', $post->body) }}" required />
            <button type="submit">更新</button>
        </form>
    </div>
</x-app-layout>

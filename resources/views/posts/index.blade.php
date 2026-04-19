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

        @foreach($posts as $post)
            <div>
                {{ $post->user_name ?? $post->user?->name ?? '匿名' }} : {{ $post->body }}
                @if($post->user_id === auth()->id())
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                @endif
            </div>
        @endforeach

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="text" name="body" value="{{ old('body') }}" required>
            <button type="submit">送信</button>
        </form>
    </div>
</x-app-layout>

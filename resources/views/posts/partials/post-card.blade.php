<div class="flex justify-between items-center mb-1">
    <div class="flex items-center gap-3 text-sm font-semibold text-gray-800">
        <span>
            {{ $post->user_name ?? $post->user?->name ?? '匿名' }}
        </span>
        <span class="text-xs text-gray-400">
            {{ $post->created_at->format('Y/m/d H:i') }}
            @if($post->updated_at && $post->updated_at != $post->created_at)
                <span class="ml-1">(編集済み)</span>
            @endif
        </span>
    </div>
    <div class="text-right text-xs text-gray-400 space-y-1">
        <div class="flex gap-2 justify-end text-sm">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}"
                class="px-3 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                    編集
                </a>
            @endcan

            @can('delete', $post)
                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    @method('DELETE')
                    <button
                        onclick="return confirm('削除しますか？')"
                        class="px-3 border border-red-500 text-red-500 rounded hover:bg-red-50"
                    >
                        削除
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
<div class="text-gray-700">
    {{ $post->body }}
</div>

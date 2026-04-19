<form method="POST" action="{{ $action }}" class="space-y-3">
    @csrf

    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="body" :value="$title ?? '投稿'" />

        <textarea
            id="body"
            name="body"
            required
            rows="1"
            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300"
            placeholder="メッセージを入力...">{{ old('body', $post->body ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
    </div>

    <div class="text-right">
        <button
            type="submit"
            class="px-4 py-2 rounded font-semibold text-xs uppercase tracking-widest transition bg-blue-500 text-white hover:bg-blue-600 dark:bg-blue-400 dark:text-gray-900 dark:hover:bg-blue-300"
        >
            {{ $button ?? '送信' }}
        </button>
    </div>
</form>

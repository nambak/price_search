<div>
    <form wire:submit.prevent="submit" class="flex justify-center">
        <input type="text" wire:model="keyword" class="rounded w-3/6 mr-2">
        @error('keyword') <span class="error">{{ $message }}</span> @enderror
        <button type="submit" class="rounded px-6 bg-green-500">검색</button>
    </form>
</div>

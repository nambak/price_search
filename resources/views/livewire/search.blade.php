<div>
    <form wire:submit.prevent="submit" class="flex justify-center">
        <input type="text" wire:model="keyword" class="rounded w-3/6 mr-2" placeholder="검색할 상품명을 입력해 주세요.">
        <button type="submit" class="rounded px-6 bg-green-500 text-white">검색</button>
    </form>
    @if ($result)
        <a href="{{ $result['link'] }}" target="_blank">
        <h2 class="text-3xl mb-3 text-gray-500 font-bold">
            무신사<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 inline">
                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
            </svg>
        </h2>
        </a>
        <ul class="flex flex-col justify-center">
        @foreach ($result['items'] as $item)
            <li>
                <div class="mb-3 shadow bg-white rounded">
                    <img src="{{ $item['image'] }}" class="h-24 w-24 mr-3 inline-block align-middle rounded-l">
                    <div class="inline-block align-middle">
                        <div class="rounded-lg p-1 border border border-green-500 text-green-500 text-sm inline-block">{{ trim($item['brand']) }}</div>
                        <div class="text-xl font-normal">{{ $item['title'] }}</div>
                        <span class="font-bold">&#8361; {{ number_format($item['price']) }}</span>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif
</div>

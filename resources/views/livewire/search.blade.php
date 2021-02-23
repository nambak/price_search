<div>
    <form wire:submit.prevent="submit" class="flex justify-center mb-10">
        <input type="text" wire:model="keyword" class="rounded w-3/6 mr-2" placeholder="검색할 상품명을 입력해 주세요.">
        <button type="submit" class="rounded px-6 bg-green-500 text-white">검색</button>
    </form>
    @if ($result)
        <ul class="flex flex-col justify-center">
        @forelse ($result as $item)
            <li>
                <div class="mb-3 shadow bg-white rounded p-3">
                    <a href="{{ $item['link'] }}" target="_blank">
                        <img src="{{ $item['image'] }}" class="h-24 w-24 mr-3 inline-block align-middle rounded-l">
                        <div class="inline-block align-middle">
                            <div class="rounded p-1 text-white bg-black text-sm inline-block mb-1">무신사</div>
                            <div class="font-normal">{{ $item['brand']}} {{ $item['title'] }}</div>
                            <span class="font-bold text-xl">&#8361; {{ number_format($item['price']) }}</span>
                        </div>
                    </a>
                </div>
            </li>
        @empty
            <li>검색 결과가 없습니다.</li>
        @endforelse
        </ul>
    @endif
</div>

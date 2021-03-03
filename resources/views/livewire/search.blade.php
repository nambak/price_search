<div>
    <form wire:submit.prevent="submit" class="flex justify-center mb-10">
        <input type="text" wire:model="keyword" class="rounded w-3/6 mr-2 flex-grow sm:flex-none"
               placeholder="검색할 상품명을 입력해 주세요.">
        <button type="submit" class="rounded px-6 bg-green-500 text-white flex-none">검색</button>
    </form>
    @if ($result)
        <ul class="flex flex-col justify-center">
            @foreach ($result as $item)
                <li>
                    <div class="mb-3 shadow bg-white rounded p-1">
                        <a href="{{ $item['link'] }}" target="_blank">
                            <img src="{{ $item['image'] }}"
                                 class="sm:h-24 w-1/4 sm:w-24 ml-1 mr-1 sm:mr-3 inline-block align-middle rounded">
                            <div class="inline-block align-middle w-3/5">
                                <div
                                    class="rounded p-1 text-white bg-black text-xs sm:text-sm inline-block mb-1">{{ $item['site'] }}</div>
                                <p class="text-sm sm:text-base font-normal">{{ $item['title'] }}</p>
                                <span class="font-bold text-xl">&#8361; {{ number_format($item['price']) }}</span>
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

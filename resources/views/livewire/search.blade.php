<div>
    <form wire:submit.prevent="submit" class="flex justify-center mb-10">
        <input type="text" wire:model.lazy="keyword"
               class="rounded w-3/6 mr-2 flex-grow sm:flex-none"
               placeholder="검색할 상품명을 입력해 주세요.">
        <button type="submit" class="rounded px-6 bg-green-500 text-white flex-none">검색</button>
    </form>
    <div class="flex flex-row justify-center text-center">
        <div wire:loading>
            <div class="inline-flex mb-12">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                검색 중 입니다.
            </div>
        </div>
    </div>
    @if ($result)
        <ul class="flex flex-col justify-center" wire:loading.class="hidden">
            @foreach ($result as $item)
                <li>
                    <div class="mb-3 shadow bg-white rounded p-2">
                        <a href="{{ $item['link'] }}" target="_blank">
                            <img src="{{ $item['image'] }}"
                                 class="sm:h-24 w-1/4 sm:w-24 ml-1 mr-1 sm:mr-3 inline-block align-middle rounded">
                            <div class="inline-block align-middle w-3/5">
                                <div class="rounded p-1 text-white bg-black text-xs sm:text-sm inline-block mb-1">{{ $item['site'] }}</div>
                                <p class="text-sm sm:text-base font-normal">{{ $item['title'] }}</p>
                                <span class="font-bold text-xl">&#8361; {{ number_format($item['price']) }}</span>
                                @if (isset($item['couponPrice']))
                                    <span class="text-red-500 text-xs sm:text-sm">
                                        쿠폰가 &#8361; {{ number_format($item['couponPrice']) }}
                                    </span>
                                @endif
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

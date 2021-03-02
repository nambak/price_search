<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>패션 쇼핑몰 가격 비교 검색</title>

        <script data-ad-client="ca-pub-3760455502657641" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-200">
        <div class="container mx-auto p-5">
            <div class="flex justify-center">
                <h1 class="text-2xl sm:text-5xl mt-24 sm:mt-48 mb-12 sm:mb-24 mx-auto text-center">패션 쇼핑몰 가격 비교 검색</h1>
            </div>
            <livewire:search />
            <div class="flex justify-center">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
        </div>
        @livewireScripts
    </body>
</html>

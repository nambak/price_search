<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>패션 쇼핑몰 가격 비교 검색</title>
        <meta name="description" content="국내 유명 패션 온라인 쇼핑몰의 상품을 한곳에서 검색하고 가격비교 까지">

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-300">
        <div class="container mx-auto p-5">
            <div class="flex justify-center">
                <h1 class="text-2xl sm:text-5xl mt-10 sm:mt-48 mb-12 sm:mb-24 mx-auto text-center">
                    패션 쇼핑몰 가격 비교 검색
                </h1>
            </div>
            <livewire:search>
            <div class="flex justify-center">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Contact: <a href="mailto:nambak80@gmail.com">nambak80@gmail.com</a>
                </div>
            </div>
        </div>
        </div>
        @livewireScripts
    </body>
</html>
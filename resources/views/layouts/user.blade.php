<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    @include('partials.style')
    @livewireStyles
    @yield('style')
</head>

<body>
    @include('partials.user.navbar')
    <div id="main-content" class="w-full h-full overflow-y-auto bg-clay dark:bg-gray-900">
        {{ $slot }}

        @include('partials.user.footer')
    </div>
    @include('partials.script')
    @yield('script')

    @livewireScripts()
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Online</title>

    @include('partials.style')
    @livewireStyles
    @yield('style')

</head>

<body>
    <main class="bg-[#F1F7FB]">
        {{ $slot }}
    </main>

    @include('partials.script')
    @yield('script')

    @livewireScripts()
</body>

</html>

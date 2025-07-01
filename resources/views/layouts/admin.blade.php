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
    @include('partials.admin.navbar')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        @include('partials.admin.sidebar')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main class="p-4">
                {{ $slot }}
            </main>
            @include('partials.admin.footer')
        </div>

    </div>
    @include('partials.script')

    @yield('script')

    <script>
        function deleteAct(id) {
            Swal.fire({
                icon: "question",
                title: "Do you want to delete this?",
                showCancelButton: true,
                confirmButtonText: "Delete",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emit('deleteData', id)
                }
            });
        }
    </script>

    @livewireScripts()
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{ config('app.name', 'Laravel') }}
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="" crossorigin=""/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            $(function() {
                const addressSuggestions = document.querySelector('#address-suggestions');
                var debounceTimer;

                    $('#address').on('keyup', function(e) {
                    // console.log(e.target.value)
                    $('#address-suggestions').fadeIn();
                    clearTimeout(debounceTimer);

                    debounceTimer = setTimeout(() => {

                    $.ajax({
                        url: "{{ route('auto-complete') }}", 
                        method: "GET",
                        data: { address: e.target.value },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            addressSuggestions.innerHTML = response;
                            
                            $('#address-suggestions li').on('click', function(e) {
                                $('#address').val(e.target.textContent);
                            $('#address-suggestions').fadeOut();

                            })
                        },
                        error: function(xhr, status, error) {
                            // console.error('Error: ' + error);
                        }
                    });
                }, 300);
                })

                
            })
        </script>
    </body>
</html>
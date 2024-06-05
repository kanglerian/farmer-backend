<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('img/plant.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    @stack('styles')
    <style>
        html,
        body {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Roboto Mono', monospace;
            font-family: 'Source Code Pro', monospace;
        }

        td,
        th {
            white-space: nowrap;
        }

        .dataTables_length>label {
            font-size: 14px !important;
            color: #6b7280 !important;
        }

        .dataTables_info,
        .paginate_button {
            font-size: 14px !important;
            color: #6b7280 !important;
        }

        .dataTables_length>label>select {
            font-size: 14px !important;
            padding: 3px 20px 3px 15px !important;
            border-radius: 10px !important;
            margin: 5px !important;
        }

        .dataTables_filter>label {
            font-size: 14px !important;
        }

        .dataTables_filter>label>input {
            margin: 5px !important;
            border-radius: 10px !important;
        }

        #progress_bar {
            transition: width 0.5s ease;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-[#f39c12] shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex h-screen">
            <aside class="w-full md:w-3/12 bg-[#2c3e50] h-full p-5">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias impedit, fugiat amet modi provident quaerat rerum rem quis iure nostrum veniam molestiae aliquid dolorem nemo, quo officia asperiores. A ipsam reprehenderit eius, pariatur quo laudantium architecto rem sapiente unde dignissimos, odit adipisci corrupti. Nemo eligendi quaerat tempore consequuntur, exercitationem corrupti laudantium numquam accusamus rerum qui minus sapiente, explicabo molestias quo molestiae id neque! Perferendis natus nam recusandae sed aspernatur necessitatibus! Placeat ex optio minima rem iste libero assumenda facilis ipsam? A excepturi, voluptatibus quaerat reprehenderit consequatur labore similique illum atque iusto quod assumenda, iste id est distinctio saepe animi accusamus.</p>
            </aside>
            <div class="w-full md:w-9/12">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    @stack('scripts')
</body>

</html>

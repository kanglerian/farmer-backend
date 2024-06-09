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
    <div class="min-h-screen bg-gray-100 overflow-hidden">
        <main class="flex h-screen">
            <aside id="aside"
                class="hidden w-7/12 md:w-2/12 ox h-full md:flex flex-col flex-shrink-0 font-normal fixed md:static z-50 lg:flex">
                <div class="relative flex flex-col flex-1 h-full pt-0 bg-[#2c3e50] px-2 border-r-4 border-[#34495e]">
                    <div class="flex flex-col flex-1 pt-5 pb-4">
                        <div class="flex-1 px-3 space-y-1 bg-[#2c3e50] divide-y divide-[#455e78]">
                            <ul class="pb-2 space-y-2">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                        <i class="fa-solid fa-gauge-high"></i>
                                        <span class="ml-3">Dashboard</span>
                                    </a>
                                </li>
                                @if (Auth::user()->level == '1')
                                    <li>
                                        <a href="{{ route('devices.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-mobile-retro"></i>
                                            <span class="ml-3">Devices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roledevice.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-microchip"></i>
                                            <span class="ml-3">Master</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-users"></i>
                                            <span class="ml-3">Users</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->level == '0')
                                    <li>
                                        <a href="{{ route('detailroledevice.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-microchip"></i>
                                            <span class="ml-3">Pompa</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('controlling.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-house-laptop"></i>
                                            <span class="ml-3">Controlling</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('maintenances.index') }}"
                                            class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                            <span class="ml-3">Maintenance</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="pt-2 space-y-2">
                                <a href="{{ route('api-support.index') }}"
                                    class="flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group">
                                    <i class="fa-solid fa-circle-nodes"></i>
                                    <span class="ml-3">API Documentation</span>
                                </a>
                                <button type="button" class="w-full md:hidden flex items-center px-5 py-3 text-sm text-white rounded-xl hover:bg-[#e67e22] group" onclick="sidebarToggle()">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    <span class="ml-3">Kembali</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 justify-center hidden w-full p-4 space-x-4 bg-[#e67e22] lg:flex"
                        sidebar-bottom-menu>
                        <a href="#"
                            class="inline-flex items-center justify-center px-3 py-2 text-white rounded-xl cursor-pointer hover:text-gray-500 hover:bg-gray-100">
                            <i class="fa-solid fa-sliders"></i>
                        </a>
                        <a href="{{ route('dashboard') }}" data-tooltip-target="tooltip-settings"
                            class="inline-flex items-center justify-center px-3 py-2 text-white rounded-xl cursor-pointer hover:text-gray-500 hover:bg-gray-100">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                        <div id="tooltip-settings" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Settings page
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </aside>
            <section class="w-full md:w-10/12 flex flex-col h-screen">
                @include('layouts.navigation')
                <header class="bg-[#e67e22]">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                <div class="px-5 md:px-0 overflow-auto h-full">
                    {{ $slot }}
                </div>
            </section>
        </main>
    </div>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        const sidebarToggle = () => {
            $('#aside').toggle();
        }
    </script>
    @stack('scripts')
</body>

</html>

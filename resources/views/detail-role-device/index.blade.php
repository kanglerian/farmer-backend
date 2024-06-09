<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl space-x-1 text-white leading-tight">
            <i class="fa-solid fa-microchip"></i>
            <span>{{ __('Role Devices') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div id="alert" class="flex items-center p-4 mb-4 text-green-800 rounded-xl bg-green-50"
                    role="alert">
                    <i class="fa-solid fa-circle-info"></i>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('message') }}
                    </div>
                    <button type="button" onclick="document.getElementById('alert').style.display = 'none';"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
            @if (count($detailroledevices) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($detailroledevices as $detailroledevice)
                        <div class="relative bg-white p-8 rounded-3xl">
                            <div class="space-y-2">
                                <a href="{{ route('controlling.show', $detailroledevice['id_sub_device']) }}"
                                    class="text-gray-900 hover:text-sky-700 text-xl font-bold">{{ $detailroledevice['devices']['name'] }}</a>
                                <ul class="text-gray-700 text-sm space-y-2">
                                    <li>
                                        <a target="_blank" class="hover:underline"
                                            href="https://google.com/maps?q={{ $detailroledevice['devices']['coordinate_device_x'] }},{{ $detailroledevice['devices']['coordinate_device_y'] }}">
                                            <i class="fa-solid fa-location-dot me-1 text-sky-500"></i>
                                            Lokasi Sub Device
                                        </a>
                                    </li>
                                    <li class="text-sm text-gray-500">
                                        <i class="fa-solid fa-user me-1"></i>
                                        {{ $detailroledevice['roledevice']['users']['name'] }}
                                    </li>
                                    <li class="text-sm text-gray-500">
                                        <i class="fa-solid fa-circle-info me-1"></i>
                                        @if (isset($detailroledevice['controlling']) && isset($detailroledevice['detail_controlling']))
                                            @php
                                                $controllingDate = \Carbon\Carbon::parse($detailroledevice['controlling']['date']);
                                                $dateNow = \Carbon\Carbon::now();
                                                $diffInDays = $controllingDate->diffInDays($dateNow);
                                                $temperature = (int)$detailroledevice['detail_controlling']['temperature'];
                                                $watt = (int)$detailroledevice['detail_controlling']['watt'];
                                            @endphp
                                            @if ($diffInDays > 30 && $temperature > 60 && $watt < 220)
                                                Butuh Perawatan
                                            @else
                                                Good
                                            @endif
                                        @else
                                            Good
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <i class="absolute right-5 top-10 text-gray-200 fa-solid fa-house-signal text-3xl"></i>
                            <hr class="my-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('controlling.show', $detailroledevice['id_sub_device']) }}"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-xs text-white px-5 py-2 rounded-xl"><i
                                            class="fa-solid fa-cogs me-1"></i> Control</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-700 mt-10"><i class="fa-solid fa-microchip me-1"></i> Belum ada sub
                    perangkat yang terdaftar.</p>
            @endif

        </div>
    </div>
</x-app-layout>

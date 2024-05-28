<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('devices.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Devices</span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <a href="{{ route('devices.show', $subdevice->id_device) }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-sky-600 md:ms-2">{{ $subdevice->device->name }}
                            ({{ $subdevice->device->location }})</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <span class="ms-1 text-sm font-medium text-gray-500 ms-2">
                            {{ $subdevice->name }} ({{ $subdevice->location }})
                        </span>
                    </div>
                </li>
            </ol>
            <input type="hidden" id="id_subdevice" value="{{ $subdevice->id }}">
        </div>
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

            <section class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <a href="{{ route('maintenances.show', $subdevice->id) }}" class="bg-sky-500 hover:bg-sky-600 text-white flex items-center gap-3 p-5 rounded-2xl">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <h2>Maintenance</h2>
                </a>
                <a href="{{ route('controlling.show', $subdevice->id) }}" class="bg-sky-500 hover:bg-sky-600 text-white flex items-center gap-3 p-5 rounded-2xl">
                    <i class="fa-solid fa-wifi"></i>
                    <h2>Controlling</h2>
                </a>
            </section>
        </div>
    </div>
</x-app-layout>

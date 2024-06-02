<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('controlling.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-house-signal"></i>
                        <span>Controlling</span>
                    </a>
                </li>
            </ol>
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
            <section class="w-full px-5">
                <form action="{{ route('roledevice.store') }}" method="post" class="w-full space-y-5">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-1 gap-5">
                        <div class="p-8 pb-12 bg-gray-50 space-y-4 border border-gray-300 rounded-2xl">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium">Nama Mesin</label>
                                <input type="text" id="name" value="{{ $controlling->device->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    readonly>
                            </div>
                            <div>
                                <label for="location" class="block mb-2 text-sm font-medium">Lokasi</label>
                                <input type="text" id="location" value="{{ $controlling->device->coordinate_device_x }} , {{ $controlling->device->coordinate_device_y }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    readonly>
                            </div>
                            <div>
                                <label for="date" class="block mb-2 text-sm font-medium">Tanggal</label>
                                <input type="date" id="date" name="date" value="{{ $controlling->date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly>
                            </div>
                            <div class="relative">
                                <label for="date" class="block mb-2 text-sm font-medium">
                                    <span>Durasi: </span>
                                    <span id="preview_duration">{{ $controlling->duration }} menit</span>
                                </label>
                                <input id="duration" name="duration" onchange="setDuration()" type="range"
                                    value="{{ $controlling->duration }}" min="0" max="300"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                <span class="text-sm text-gray-500 absolute start-0 -bottom-6">0 menit</span>
                                <span class="text-sm text-gray-500 absolute end-0 -bottom-6">300 menit</span>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    @push('scripts')
        <script>
            const setDuration = () => {
                ;
                let duration = $('#duration').val();
                console.log(duration);
                $('#preview_duration').text(`${duration} menit`);
            }
        </script>
    @endpush
</x-app-layout>

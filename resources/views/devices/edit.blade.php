<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('devices.index') }}"
                        class="inline-flex items-center text-sm font-medium text-white space-x-2">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Devices</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-white"></i>
                        <span class="text-sm font-medium text-white ms-2">Edit</span>
                    </div>
                </li>
            </ol>
        </nav>

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
            <form method="POST" action="{{ route('devices.update', $device->id) }}"
                class="max-w-sm bg-white mx-auto md:mx-0 p-10 rounded-2xl">
                @csrf
                @method('PATCH')
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Device</label>
                    <input type="text" id="name" name="name" value="{{ $device->name }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Nama Device" required />
                </div>
                <div class="mb-5">
                    <label for="coordinate_device_x" class="block mb-2 text-sm font-medium text-gray-900">Koordinat
                        Device X</label>
                    <input type="text" id="coordinate_device_x" name="coordinate_device_x"
                        value="{{ $device->coordinate_device_x }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Koordinat Device X" required />
                </div>
                <div class="mb-5">
                    <label for="coordinate_device_y" class="block mb-2 text-sm font-medium text-gray-900">Koordinat
                        Device Y</label>
                    <input type="text" id="coordinate_device_y" name="coordinate_device_y"
                        value="{{ $device->coordinate_device_y }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Koordinat Device Y" required />
                </div>
                <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                    <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5">
                        <option value="{{ $device->status }}">{{ $device->status }}</option>
                        <option value="Master">Master</option>
                        <option value="Pompa">Pompa</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="condition" class="block mb-2 text-sm font-medium text-gray-900">Kondisi</label>
                    <input type="text" id="condition" name="condition" value="{{ $device->condition }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Kondisi" required />
                </div>
                <button type="submit"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            }

            function showPosition(position) {
                const {
                    latitude,
                    longitude
                } = position.coords;
                document.getElementById('coordinate_device_x').value = latitude;
                document.getElementById('coordinate_device_y').value = longitude;
            }
            getLocation();
        </script>
    @endpush
</x-app-layout>

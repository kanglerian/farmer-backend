<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('roledevice.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Role Devices</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <span class="ms-1 text-sm font-medium text-gray-500 ms-2">Tambah</span>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="w-full">
                            <label for="id_device" class="block mb-2 text-sm font-medium text-gray-900">Nama Device
                                Master</label>
                            <select id="id_device" name="id_device" onchange="checkDevice()"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block p-2.5">
                                <option>Pilih</option>
                                @foreach ($devices_master as $device_master)
                                    <option value="{{ $device_master->id }}">{{ $device_master->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="id_user" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Petugas</label>
                            <select id="id_user" name="id_user"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block p-2.5">
                                <option>Pilih</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5">
                        <div class="p-5 bg-gray-50 border border-gray-300 rounded-2xl">
                            <ul class="text-sm space-y-2">
                                <li>
                                    <span class="font-medium">Nama Device: </span>
                                    <span id="preview_name_device">Tidak ada</span>
                                </li>
                                <li>
                                    <span class="font-medium">Koordinat: </span>
                                    <span id="preview_coordinate_x">0</span>,
                                    <span id="preview_coordinate_y">0</span>,
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-5 rounded-2xl border border-gray-300">
                        <div class="relative overflow-x-auto rounded-xl">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-white">
                                            Sub Device
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-white">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="form-sub-devices">
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-white">
                                            <select name="id_sub_device[]"
                                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block p-2.5"
                                                required>
                                                <option>Pilih</option>
                                                @foreach ($devices as $device)
                                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="text" name="status[]"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                                placeholder="Status" required />
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <button onclick="addSubdevice()" type="button"
                                                class="hover:text-sky-500"><i
                                                    class="fa-solid fa-circle-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </form>
            </section>
        </div>
    </div>
    @push('scripts')
        <script>
            const checkDevice = async () => {
                const idDevice = $('#id_device').val();
                await axios.get(`/api/device/${idDevice}`)
                    .then((response) => {
                        const device = response.data.result;
                        $('#preview_name_device').text(device.name);
                        $('#preview_coordinate_x').text(device.coordinate_device_x);
                        $('#preview_coordinate_y').text(device.coordinate_device_y);
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }

            const addSubdevice = () => {
                const element = `<tr>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-white">
                                            <select name="id_sub_device[]"
                                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block p-2.5" required>
                                                <option>Pilih</option>
                                                @foreach ($devices as $device)
                                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="text" name="status[]"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                            placeholder="Status" required />
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <button onclick="addSubdevice()" type="button" class="hover:text-sky-500"><i class="fa-solid fa-circle-plus"></i></button>
                                            <button onclick="removeSubdevice(this)" type="button" class="hover:text-red-500"><i class="fa-solid fa-circle-minus"></i></button>
                                        </td>
                                    </tr>`
                $('#form-sub-devices').append(element);
            }

            const removeSubdevice = (button) => {
                button.closest('tr').remove();
            }
        </script>
    @endpush
</x-app-layout>

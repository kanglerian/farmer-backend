<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('maintenances.index') }}"
                        class="inline-flex items-center text-sm font-medium text-white space-x-2">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <span>Maintenance</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-white"></i>
                        <span class="text-sm font-medium text-white ms-2">Tambah</span>
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
                <form action="{{ route('maintenances.store') }}" method="post" class="w-full space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="w-full">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                            <input type="date" id="date" name="date"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                placeholder="Tanggal" required />
                        </div>
                        <div class="w-full">
                            <label for="id_device" class="block mb-2 text-sm font-medium text-gray-900">Nama Device
                                Master</label>
                            <select id="id_device" name="id_device"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block p-2.5">
                                <option>Pilih</option>
                                @foreach ($devices as $device)
                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="maintenance" class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                Maintenance</label>
                            <input type="text" id="maintenance" name="maintenance"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                placeholder="Jenis Maintenance" required />
                        </div>
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="bg-gray-50 p-5 rounded-2xl border border-gray-300">
                        <div class="relative overflow-x-auto rounded-xl">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-white">
                                            Detail Maintenance
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tarif
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-white">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="form-maintenance">
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-white">
                                            <input type="text" name="detail[]"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                                placeholder="Detail Maintenance" required />
                                        </th>
                                        <td class="px-6 py-4">
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <i class="fa-solid fa-coins"></i>
                                                </div>
                                                <input type="number" name="cost[]" id="cost"
                                                    aria-describedby="helper-text-explanation"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                                    placeholder="Tarif" required />
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <button onclick="addMaintenance()" type="button"
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
            const addMaintenance = () => {
                const element = `
                <tr>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-white">
                                            <input type="text" name="detail[]"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                                                placeholder="Detail Maintenance" required />
                                        </th>
                                        <td class="px-6 py-4">
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <i class="fa-solid fa-coins"></i>
                                                </div>
                                                <input type="number" name="cost[]" id="cost"
                                                    aria-describedby="helper-text-explanation"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                                    placeholder="Tarif" required />
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 bg-white">
                                            <button onclick="addMaintenance()" type="button"
                                                class="hover:text-sky-500"><i
                                                    class="fa-solid fa-circle-plus"></i></button>
                                            <button onclick="removeMaintenance(this)" type="button" class="hover:text-red-500"><i class="fa-solid fa-circle-minus"></i></button>
                                        </td>
                                    </tr>`
                $('#form-maintenance').append(element);
            }

            const removeMaintenance = (button) => {
                button.closest('tr').remove();
            }
        </script>
    @endpush
</x-app-layout>

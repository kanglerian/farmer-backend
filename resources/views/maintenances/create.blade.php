<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('devices.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <span>Maintenances</span>
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
            <form method="POST" action="{{ route('devices.store') }}"
                class="max-w-sm bg-white mx-auto md:mx-0 p-10 rounded-2xl">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Device</label>
                    <input type="text" id="name" name="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Nama Device" required />
                </div>
                <div class="mb-5">
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                    <input type="text" id="location" name="location"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 "
                        placeholder="Lokasi" required />
                </div>
                <div class="mb-5">
                    <label for="id_user" class="block mb-2 text-sm font-medium text-gray-900">Petugas</label>
                    <select id="id_user" name="id_user"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5">
                        <option>Pilih</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </form>
        </div>
    </div>

</x-app-layout>
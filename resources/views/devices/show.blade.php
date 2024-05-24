<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('devices.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Devices</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <span class="ms-1 text-sm font-medium text-gray-500 ms-2">{{ $device->name }} ({{ $device->location }})</span>
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
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-xl focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 px-5 md:px-0 mb-5">
                <button type="button" onclick="toggleModal()"
                    class="inline-block text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5"><i
                        class="fa-solid fa-circle-plus me-1"></i> Tambah</button>
                <div class="w-full md:w-auto grid grid-cols-1 gap-3">
                    <div class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl">
                        <h4 class="text-sm">Sub Devices</h4>
                        <span class="font-medium text-lg">{{ count($subdevices) }}</span>
                    </div>
                </div>
            </div>
            <section class="mx-5 md:mx-0">
                @if (count($subdevices) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($subdevices as $subdevice)
                            <div class="relative bg-white p-8 rounded-3xl">
                                <div class="flex items-end gap-4">
                                    <a href="javascript.void(0)" class="cursor-pointer"
                                        id="download-qrcode-{{ $subdevice->id }}">
                                        <img src="" id="qrcode-{{ $subdevice->id }}" alt="">
                                    </a>
                                    <div class="space-y-2">
                                        <a href="{{ route('subdevices.show', $subdevice->id) }}"
                                            class="text-gray-900 hover:text-sky-700 text-xl font-bold">{{ $subdevice->name }}</a>
                                        <ul class="text-gray-700 text-sm space-y-2">
                                            <li><i class="fa-solid fa-location-dot text-sky-500"></i>
                                                {{ $subdevice->location }}
                                            </li>
                                            <li class="text-sm"><i
                                                    class="fa-solid {{ $subdevice->condition ? 'text-emerald-500 fa-circle-check' : 'fa-circle-xmark text-red-500' }}"></i>
                                                {{ $subdevice->condition ? 'Running' : 'Not Running' }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <i class="absolute right-5 top-10 text-gray-200 fa-solid fa-house-signal text-3xl"></i>
                                <hr class="my-5">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="toggleEditModal('{{ $subdevice->id }}')"
                                            class="bg-amber-500 hover:bg-amber-600 text-xs text-white px-5 py-2 rounded-xl"><i
                                                class="fa-solid fa-edit me-1"></i> Ubah</button>
                                        <button type="button" onclick="toggleDeleteModal('{{ $subdevice->id }}')"
                                            class="bg-red-500 hover:bg-red-600 text-xs text-white px-5 py-2 rounded-xl"><i
                                                class="fa-solid fa-trash-can me-1"></i> Hapus</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-700 mt-10"><i class="fa-solid fa-microchip me-1"></i> Belum ada sub
                        perangkat yang terdaftar.</p>
                @endif
            </section>
        </div>
    </div>
    @include('devices.modal.create')
    @include('devices.modal.edit')
    @include('devices.modal.delete')
    @push('scripts')
        <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
        <script src="{{ asset('js/qrcode.js') }}"></script>
        <script>
            const rangeFunction = (id) => {
                let range = document.getElementById(`duration-${id}`).value;
                document.getElementById(`duration-value-${id}`).innerText = range;
            }
            const getSubdevices = async () => {
                const device = document.getElementById('id_device').value;
                await axios.get(`/api/subdevices/${device}`)
                    .then((response) => {
                        const data = response.data.subDevices;
                        data.forEach(element => {
                            QRCode.toDataURL('cek', {
                                type: 'image/jpeg',
                                quality: 5,
                                margin: 0,
                            }, function(error, string) {
                                if (error) console.log(error);
                                let nameData = element.device.name.toLowerCase();
                                let subnameData = element.name.toLowerCase();
                                let locationData = element.device.location.toLowerCase();
                                let sublocationData = element.location.toLowerCase();
                                let nameDevice = nameData.replaceAll(' ', '-');
                                let nameSubDevice = subnameData.replaceAll(' ', '-');
                                let locationDevice = locationData.replaceAll(' ', '-');
                                let locationSubDevice = sublocationData.replaceAll(' ', '-');
                                document.getElementById(`qrcode-${element.id}`).src = string;
                                document.getElementById(`download-qrcode-${element.id}`).href =
                                    string;
                                document.getElementById(`download-qrcode-${element.id}`)
                                    .setAttribute('download',
                                        `${nameDevice}_${locationDevice}_${nameSubDevice}_${locationSubDevice}`
                                    );
                            })
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            getSubdevices();
        </script>
    @endpush
</x-app-layout>

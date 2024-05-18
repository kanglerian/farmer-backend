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
                        <span class="ms-1 text-sm font-medium text-gray-500 ms-2">{{ $device->name }}
                            ({{ $device->location }})</span>
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
            <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mx-5 md:mx-0">
                @forelse ($subdevices as $subdevice)
                    <div class="relative bg-white p-8 rounded-3xl">
                        <div class="flex items-end gap-4">
                            <a href="#" class="cursor-pointer" id="download-qrcode-{{ $subdevice->id }}">
                                <img src="" id="qrcode-{{ $subdevice->id }}" alt="">
                            </a>
                            <div class="space-y-2">
                                <h2 class="text-gray-900 text-xl font-bold">{{ $subdevice->name }}</h2>
                                <ul class="text-gray-700 text-sm space-y-2">
                                    <li><i class="fa-solid fa-location-dot text-sky-500"></i> {{ $subdevice->location }}
                                    </li>
                                    <li class="text-sm"><i
                                            class="fa-solid {{ $subdevice->condition ? 'text-emerald-500 fa-circle-check' : 'fa-circle-xmark text-red-500' }}"></i>
                                        {{ $subdevice->condition ? 'Running' : 'Not Running' }}</li>
                                </ul>
                            </div>
                        </div>
                        <i class="absolute right-5 top-10 text-gray-200 fa-solid fa-house-signal text-3xl"></i>
                        <hr class="my-5">
                        <div class="space-x-1">
                            <button type="button" onclick="toggleEditModal('{{ $subdevice->id }}')" class="bg-amber-500 hover:bg-amber-600 text-xs text-white px-5 py-2 rounded-xl"><i class="fa-solid fa-edit me-1"></i> Ubah</button>
                            <form action="{{ route('subdevices.destroy', $subdevice->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-xs text-white px-5 py-2 rounded-xl"><i class="fa-solid fa-trash-can me-1"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada</p>
                @endforelse
            </section>
        </div>
    </div>

    <div id="subdevice-create-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Add New Sub Device
                    </h3>
                    <button type="button" onclick="toggleModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('subdevices.store') }}" class="p-6">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <input type="hidden" name="id_device" id="id_device" value="{{ $device->uuid }}">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Nama Sub Device" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                            <input type="text" name="location" id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Lokasi" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="condition" class="block mb-2 text-sm font-medium text-gray-900">Kondisi</label>
                            <select id="condition" name="condition"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="">Pilih Kondisi</option>
                                <option value="1">Running</option>
                                <option value="0">Not Running</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 gap-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                        <i class="fa-solid fa-plus"></i>
                        Add sub device
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="subdevice-edit-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Ubah <span id="subdevice_name"></span>
                    </h3>
                    <button type="button" onclick="toggleEditModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="" id="form-update-subdevice" class="p-6">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="name" id="name_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Nama Sub Device" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                            <input type="text" name="location" id="location_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Lokasi" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="condition" class="block mb-2 text-sm font-medium text-gray-900">Kondisi</label>
                            <select name="condition" id="condition_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="">Pilih Kondisi</option>
                                <option value="1">Running</option>
                                <option value="0">Not Running</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-sky-700 gap-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                        <i class="fa-solid fa-save"></i>
                        Simpan perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
        <script src="{{ asset('js/qrcode.js') }}"></script>
        <script>
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
        <script>
            const toggleModal = () => {
                const modal = document.getElementById('subdevice-create-modal');
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            }

            const toggleEditModal = (id) => {
                const modal = document.getElementById('subdevice-edit-modal');
                if (modal.classList.contains('hidden')) {
                    getInfoSubDevice(id);
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            }

            const getInfoSubDevice = async (id) => {
                await axios.get(`/api/subdevice/${id}`)
                .then((response) => {
                    const data = response.data.subdevice;
                    document.getElementById('subdevice_name').innerText = data.name;
                    document.getElementById('name_edit').value = data.name;
                    document.getElementById('location_edit').value = data.location;
                    document.getElementById('condition_edit').value = data.condition;
                    let urlUpdate = "{{ route('subdevices.update', ':id') }}".replace(':id', data.id);
                    document.getElementById('form-update-subdevice').setAttribute("action",urlUpdate);
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        </script>
    @endpush
</x-app-layout>

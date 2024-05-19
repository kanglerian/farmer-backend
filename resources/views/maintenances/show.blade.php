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
                    <a href="{{ route('devices.show', $subdevice->id_device) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">{{ $subdevice->device->name }} ({{ $subdevice->device->location }})</a>
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
            <header class="mb-5 space-y-1 mx-5 md:mx-0">
                <h2 class="font-bold text-2xl">Maintenance</h2>
                <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, ducimus.</p>
            </header>
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 px-5 md:px-0 mb-5">
                <button type="button" onclick="toggleModal()"
                    class="inline-block text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5"><i
                        class="fa-solid fa-circle-plus me-1"></i> Tambah</button>
                <div class="w-full md:w-auto grid grid-cols-1 gap-3">
                    <div class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl">
                        <h4 class="text-sm">Perawatan</h4>
                        <span class="font-medium text-lg">{{ $total_maintenance }}</span>
                    </div>
                </div>
            </div>
            <section class="bg-white p-10 rounded-2xl">
                <div class="relative overflow-x-auto">
                    <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500" id="table-maintenance">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keluhan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Biaya
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    @include('maintenances.modal-subdevice.create')
    @push('scripts')
        <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
        <script src="{{ asset('js/qrcode.js') }}"></script>
        <script>
            let devices;
            let dataTableInstance;
            let dataTableInitialized = false;
            let idSubdevice = document.getElementById('id_subdevice').value;
            let urlMaintenance = `/api/maintenances/${idSubdevice}`;

            const DataTableMaintenance = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlMaintenance);
                        const maintenances = response.data.maintenances;

                        let columnConfigs = [{
                            data: 'id',
                            render: (data, type, row, meta) => {
                                return meta.row + 1;
                            },
                        }, {
                            data: 'date',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'problem',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'cost',
                            render: (data, type, row, meta) => {
                                return `Rp${data.toLocaleString('id-ID')}`;
                            },
                        }, {
                            data: {
                                id: 'id',
                            },
                            render: (data, type, row, meta) => {
                                let editUrl = "{{ route('devices.edit', ':id') }}".replace(
                                    ':id', data.id);
                                let showUrl = "{{ route('devices.show', ':id') }}".replace(
                                    ':id', data.id);
                                return `
                                <div class="flex items-center gap-1">
                                    <a href="${showUrl}" class="bg-emerald-500 hover:bg-emerald-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="${editUrl}" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-xs text-white" onclick="event.preventDefault(); deleteMaintenance('${data.id}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                `;
                            },
                        }];

                        const dataTableConfig = {
                            data: maintenances,
                            columnDefs: [{
                                width: 50,
                                target: 0
                            }],
                            columns: columnConfigs
                        }

                        let results = {
                            config: dataTableConfig,
                            initialized: true,
                        }
                        resolve(results);
                    } catch (error) {
                        reject(error);
                    }
                });
            }

            const promiseDataMaintenance = () => {
                Promise.all([
                        DataTableMaintenance(),
                    ])
                    .then((response) => {
                        let responseDTS = response[0];
                        dataTableInstance = $('#table-maintenance').DataTable(responseDTS.config);
                        dataTableInitialized = responseDTS.initialized;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataMaintenance();
        </script>

        <script>
            const deleteMaintenance = async (data) => {
                const message = confirm('Apakah anda yakin akan menghapus perangkat?');
                if (message) {
                    await axios.post(`/devices/${data}`, {
                            '_method': 'DELETE',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        })
                        .then((response) => {
                            alert(response.data.message);
                            location.reload();
                        })
                        .catch((error) => {
                            alert('Perangkat tidak dapat dihapus!')
                            console.log(error);
                        });
                }
            }
        </script>
    @endpush
</x-app-layout>

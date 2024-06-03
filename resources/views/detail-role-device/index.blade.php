<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl space-x-1 text-gray-800 leading-tight">
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
            <div class="flex flex-col md:flex-row items-center justify-end gap-5 px-5 md:px-0 mb-5">
                <div class="w-full md:w-auto grid grid-cols-1 gap-3">
                    <div class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl">
                        <h4 class="text-sm">Role Devices</h4>
                        <span class="font-medium text-lg">{{ $total }}</span>
                    </div>
                </div>
            </div>
            <section class="bg-white p-10 rounded-2xl">
                <div class="relative overflow-x-auto">
                    <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500" id="table-devices">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Device
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Koordinat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Petugas
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
    @push('scripts')
        <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
        <script src="{{ asset('js/qrcode.js') }}"></script>
        <script>
            let devices;
            let dataTableInstance;
            let dataTableInitialized = false;
            let urlDevice = '/get/detailroledevices';

            const DataTableDevices = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlDevice);
                        const resultData = response.data.results;
                        console.log(resultData);
                        let columnConfigs = [{
                            data: 'id',
                            render: (data, type, row, meta) => {
                                return meta.row + 1;
                            },
                        }, {
                            data: 'devices',
                            render: (data, type, row, meta) => {
                                return data.name;
                            },
                        }, {
                            data: 'devices',
                            render: (data, type, row, meta) => {
                                console.log(data);
                                return `${data.coordinate_device_x}, ${data.coordinate_device_y}`;
                            },
                        }, {
                            data: 'devices',
                            render: (data, type, row, meta) => {
                                return data.status;
                            },
                        }, {
                            data: 'roledevice',
                            render: (data, type, row, meta) => {
                                return data.users.name;
                            },
                        }, {
                            data: {
                                id: 'id',
                                id_sub_device: 'id_sub_device'
                            },
                            render: (data, type, row, meta) => {
                                let showUrl = "{{ route('controlling.show', ':id') }}".replace(
                                    ':id', data.id_sub_device);
                                return `
                                <div class="flex items-center gap-1">
                                    <a href="${showUrl}" class="bg-emerald-500 hover:bg-emerald-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-cogs"></i>
                                    </a>
                                </div>
                                `;
                            },
                        }];

                        const dataTableConfig = {
                            data: resultData,
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

            const promiseDataDevices = () => {
                Promise.all([
                        DataTableDevices(),
                    ])
                    .then((response) => {
                        let responseDTS = response[0];
                        dataTableInstance = $('#table-devices').DataTable(responseDTS.config);
                        dataTableInitialized = responseDTS.initialized;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataDevices();
        </script>

        <script>
            const deleteDevice = async (data) => {
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

            const downloadQRCode = async (data) => {
                QRCode.toFile(``)
                console.log(data);
            }
        </script>
    @endpush
</x-app-layout>
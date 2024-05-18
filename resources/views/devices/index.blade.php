<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl space-x-1 text-gray-800 leading-tight">
            <i class="fa-solid fa-microchip"></i>
            <span>{{ __('Devices') }}</span>
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
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 px-5 md:px-0 mb-5">
                <a href="{{ route('devices.create') }}"
                    class="inline-block text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5"><i
                        class="fa-solid fa-circle-plus me-1"></i> Tambah</a>
                <div class="w-full md:w-auto grid grid-cols-1 gap-3">
                    <div class="bg-sky-500 text-white px-5 py-2.5 rounded-2xl">
                        <h4 class="text-sm">Devices</h4>
                        <span class="font-medium text-lg">{{ $total_devices }}</span>
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
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Lokasi
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
            let urlDevice = '/api/devices';

            const DataTableDevices = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlDevice);
                        const devices = response.data.devices;

                        let columnConfigs = [{
                            data: 'id',
                            render: (data, type, row, meta) => {
                                return meta.row + 1;
                            },
                        }, {
                            data: 'uuid',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'name',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'location',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: {
                                id_user: 'id_user',
                                petugas: 'petugas'
                            },
                            render: (data, type, row, meta) => {
                                return data ? data.petugas.name : 'Tidak diketahui';
                            },
                        }, {
                            data: {
                                id: 'id',
                                uuid: 'uuid',
                                name: 'name',
                                location: 'location'
                            },
                            render: (data, type, row, meta) => {
                                let qrcodeVal;
                                QRCode.toDataURL(data.uuid, {
                                    type: 'image/jpeg',
                                    quality: 5,
                                    margin: 3,
                                }, function(error, string) {
                                    if (error) console.log(error);
                                    qrcodeVal = string;
                                })
                                let nameData = data.name.toLowerCase();
                                let locationData = data.location.toLowerCase();
                                let nameDevice = nameData.replaceAll(' ', '-');
                                let locationDevice = locationData.replaceAll(' ', '-');
                                let editUrl = "{{ route('devices.edit', ':id') }}".replace(
                                    ':id', data.id);
                                let showUrl = "{{ route('devices.show', ':id') }}".replace(
                                    ':id', data.uuid);
                                return `
                                <div class="flex items-center gap-1">
                                    <a href="${showUrl}" class="bg-emerald-500 hover:bg-emerald-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="${qrcodeVal}" class="bg-sky-500 hover:bg-sky-600 px-3 py-1 rounded-lg text-xs text-white" download="${nameDevice}_${locationDevice}">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                    <a href="${editUrl}" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-xs text-white" onclick="event.preventDefault(); deleteDevice('${data.id}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                `;
                            },
                        }];

                        const dataTableConfig = {
                            data: devices,
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

                        const qrcodes = responseDTS.config.data;
                        qrcodes.forEach(qrcode => {
                            let canvas = document.getElementById(`qrcode-${qrcode.id}`);
                            QRCode.toCanvas(canvas, `satu`, function(error) {
                                if (error) console.error(error)
                            });
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataDevices();
        </script>

        <script>
            const deleteDevice = async (data) => {
                await axios.post(`/devices/${data}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then((response) => {
                        alert(response.data.message);
                        location.reload();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }

            const downloadQRCode = async (data) => {
                QRCode.toFile(``)
                console.log(data);
            }
        </script>
    @endpush
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl space-x-1 text-gray-800 leading-tight">
            <i class="fa-solid fa-wifi"></i>
            <span>{{ __('Controlling') }}</span>
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
            <section class="bg-white p-10 rounded-2xl">
                <div class="relative overflow-x-auto">
                    <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500" id="table-devices">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Sub Device
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Device
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Durasi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
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
            let urlEndpoint = '/api/controllings';

            const DataTableDevices = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlEndpoint);
                        const resultData = response.data.result;
                        console.log(resultData);
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
                            data: {
                                id: 'id',
                                subdevice: 'subdevice',
                            },
                            render: (data, type, row, meta) => {
                                let showUrl = "{{ route('detailcontrolling.show', ':id') }}".replace(
                                    ':id', data.id);
                                return `<a href="${showUrl}" class="underline">${data.subdevice.name} - ${data.subdevice.location}</a>`;
                            },
                        }, {
                            data: 'subdevice',
                            render: (data, type, row, meta) => {
                                return `${data.device.name} - ${data.device.location}`;
                            },
                        }, {
                            data: 'duration',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'status',
                            render: (data, type, row, meta) => {
                                return data ? 'Aktif' : 'Tidak aktif';
                            },
                        }, ];

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

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <ol class="inline-flex items-center space-x-3 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('controlling.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 space-x-2">
                        <i class="fa-solid fa-house-signal"></i>
                        <span>Controlling</span>
                    </a>
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-5 sm:px-6 lg:px-8">
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
            <section class="w-full grid grid-cols-1 md:grid-cols-2 gap-5 px-5">
                <form action="{{ route('controlling.store') }}" method="post"
                    class="w-full bg-white p-10 rounded-2xl border border-gray-200">
                    @csrf
                    <div class="grid grid-cols-1 gap-5">
                        <input type="hidden" name="id_sub_device" value="{{ $detailroledevice->devices->id }}">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium">Nama Mesin</label>
                            <input type="text" id="name" value="{{ $detailroledevice->devices->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                readonly>
                        </div>
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium">Lokasi</label>
                            <input type="text" id="location"
                                value="{{ $detailroledevice->devices->coordinate_device_x }},{{ $detailroledevice->devices->coordinate_device_y }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                readonly>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium">Tanggal</label>
                            <input type="date" id="date" name="date" value="{{ $controlling->date ?? '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                            <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5">
                                <option value="{{ $controlling->status ?? '' }}">{{ $controlling->status ?? 'Pilih' }}
                                </option>
                                <option value="Running">Running</option>
                                <option value="Not Running">Not Running</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label for="date" class="block mb-2 text-sm font-medium">
                                <span>Durasi: </span>
                                <span id="preview_duration">{{ $controlling->duration ?? 0 }} menit</span>
                            </label>
                            <input id="duration" name="duration" value="{{ $controlling->duration ?? 0 }}"
                                onchange="setDuration()" type="range" value="0" min="0" max="300"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            <span class="text-sm text-gray-500 absolute start-0 -bottom-6">0 menit</span>
                            <span class="text-sm text-gray-500 absolute end-0 -bottom-6">300 menit</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white mt-14 bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                        <i class="fa-solid fa-play"></i>
                        <span>Mulai</span>
                    </button>
                </form>
                <div class="bg-white p-10 rounded-2xl border border-gray-200">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem, sapiente cum sequi
                        molestiae, ad, ex debitis tempore maiores distinctio dolorum dolore eaque corrupti aliquam
                        ratione aliquid voluptas placeat rem excepturi.</p>
                </div>
            </section>

            @if ($controlling)
                <section class="bg-white border border-gray-200 p-10 rounded-2xl">
                    <div class="relative overflow-x-auto">
                        <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500"
                            id="table-devices">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Suhu
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Watt
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
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            const setDuration = () => {
                ;
                let duration = $('#duration').val();
                console.log(duration);
                $('#preview_duration').text(`${duration} menit`);
            }
        </script>
    @endpush

    @if ($controlling)
        @push('scripts')
            <script>
                let devices;
                let dataTableInstance;
                let dataTableInitialized = false;
                let urlEndpoint = `/api/detailcontrolling/10`;

                const DataTableDevices = async () => {
                    return new Promise(async (resolve, reject) => {
                        try {
                            const response = await axios.get(urlEndpoint);
                            const resultData = response.data.results;
                            console.log(resultData);
                            let columnConfigs = [{
                                data: 'id',
                                render: (data, type, row, meta) => {
                                    return meta.row + 1;
                                },
                            }, {
                                data: 'temperature',
                                render: (data, type, row, meta) => {
                                    return data;
                                },
                            }, {
                                data: 'watt',
                                render: (data, type, row, meta) => {
                                    return data;
                                },
                            }, {
                                data: {
                                    id: 'id',
                                },
                                render: (data, type, row, meta) => {
                                    let editUrl = "{{ route('roledevice.edit', ':id') }}".replace(
                                        ':id', data.id);
                                    return `
                                <div class="flex items-center gap-1">
                                    <a href="${editUrl}" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-xs text-white" onclick="event.preventDefault(); deleteDevice('${data.id}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                `;
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
    @endif
</x-app-layout>

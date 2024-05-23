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
                        <a href="{{ route('devices.show', $subdevice->id_device) }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">{{ $subdevice->device->name }}
                            ({{ $subdevice->device->location }})</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <a href="{{ route('subdevices.show', $subdevice->id) }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">{{ $subdevice->name }} ({{ $subdevice->location }})</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-300"></i>
                        <span class="ms-1 text-sm font-medium text-gray-500 ms-2">
                            Controlling
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
                <h2 class="font-bold text-2xl">Controlling</h2>
                <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, ducimus.</p>
            </header>
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 px-5 md:px-0 mb-5">
                <button type="button" onclick="toggleModal('create')"
                    class="inline-block text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5"><i
                        class="fa-solid fa-circle-plus me-1"></i> Tambah</button>
            </div>
            <section class="bg-white p-10 rounded-2xl">
                <div class="relative overflow-x-auto">
                    <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500"
                        id="table-result">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Durasi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
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
            let idSubdevice = document.getElementById('id_subdevice').value;
            let endpoint = `/api/controlling/${idSubdevice}`;

            const DataTable = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(endpoint);
                        const dataResult = response.data.result;

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
                            data: 'duration',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'status',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: {
                                id: 'id',
                            },
                            render: (data, type, row, meta) => {
                                let editUrl = "{{ route('controlling.edit', ':id') }}".replace(
                                    ':id', data.id);
                                return `
                                <div class="flex items-center gap-1">
                                    <button type="button" onclick="toggleModal('edit','${data.id}')" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-xs text-white" onclick="event.preventDefault(); deleteFunction('${data.id}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                `;
                            },
                        }];

                        const dataTableConfig = {
                            data: dataResult,
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

            const promiseData = () => {
                Promise.all([
                        DataTable(),
                    ])
                    .then((response) => {
                        let responseDTS = response[0];
                        dataTableInstance = $('#table-result').DataTable(responseDTS.config);
                        dataTableInitialized = responseDTS.initialized;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseData();
        </script>

        <script>
            const deleteFunction = async (data) => {
                const message = confirm('Apakah anda yakin akan menghapus perangkat?');
                if (message) {
                    await axios.post(`/controlling/${data}`, {
                            '_method': 'DELETE',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        })
                        .then((response) => {
                            alert(response.data.message);
                            location.reload();
                        })
                        .catch((error) => {
                            alert('Data pengendalian tidak dapat dihapus!')
                            console.log(error);
                        });
                }
            }
        </script>
        <script>
            const toggleModal = async (status, data) => {
                if (status == 'create') {
                    const url = "{{ route('controlling.store') }}";
                    $('#subject-form').attr('action', url);
                    $('#subject-header').text('Tambah Pengendalian');
                    $('#subject-button').text('Simpan');
                    $('#subject-field').html('');
                    $('#date').val('');
                    $('#problem').val('');
                    $('#cost').val('');
                } else if (status == 'edit') {
                    await axios.get(`/api/controlling/${data}`)
                        .then((response) => {
                            const result = response.data.result;
                            const token = $('meta[name="csrf-token"]').attr('content')
                            const url = "{{ route('controlling.update', ':id') }}".replace(':id', data);
                            $('#subject-header').text(`Edit Pengendalian ${maintenance.subdevice.name}`);
                            $('#subject-button').text('Simpan perubahan');
                            $('#subject-form').attr('action', url);
                            $('#subject-field').html(`<input type="hidden" name="_method" value="PATCH">`
                            );
                            $('#date').val(result.date);
                            $('#problem').val(result.problem);
                            $('#cost').val(result.cost);
                        })
                        .catch((error) => {
                            console.log(error);
                        })

                }
                $('#subject-modal').toggle();
            }
        </script>
    @endpush

    <div id="subject-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
            <!-- Modal content -->
            <div class="w-full relative bg-white rounded-2xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900" id="maintenance-header">
                        Tambah Pengendalian
                    </h3>
                    <button type="button" onclick="toggleModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('controlling.store') }}" id="maintenance-form"
                    class="w-full px-6">
                    @csrf
                    <div class="w-full grid gap-4 mb-4 grid-cols-1">
                        <div id="maintenance-field"></div>
                        <input type="hidden" name="id_subdevice" id="id_subdevice" value="{{ $subdevice->id }}">
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                            <input type="date" id="date" name="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Tanggal" required />
                        </div>
                        <div>
                            <label for="problem" class="block mb-2 text-sm font-medium text-gray-900">Keluhan</label>
                            <textarea id="problem" name="problem" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Tulis keluhan disini..."></textarea>
                        </div>
                        <div>
                            <label for="zip-input" class="block mb-2 text-sm font-medium text-gray-900">Biaya</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none text-gray-400 text-sm font-medium">
                                    Rp
                                </div>
                                <input type="number" id="cost" name="cost"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                    placeholder="0" required />
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full block text-white flex justify-center items-center gap-2 bg-blue-700 gap-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center">
                                <i class="fa-solid fa-save"></i>
                                <span id="maintenance-button">Tambah Perawatan</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl space-x-1 text-gray-800 leading-tight">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <span>{{ __('Maintenance') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 px-5 md:px-0 mb-5">
                <a href="{{ route('maintenances.create') }}"
                    class="inline-block text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-xl text-sm px-5 py-2.5"><i
                        class="fa-solid fa-circle-plus me-1"></i> Tambah</a>
            </div>
            <section class="bg-white p-10 rounded-2xl">
                <div class="relative overflow-x-auto">
                    <table class="w-full bg-white text-sm text-left rtl:text-right text-gray-500" id="table-users">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Maintenance
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
        <script>
            let users;
            let dataTableInstance;
            let dataTableInitialized = false;
            let urlUser = '/api/maintenances';

            const DataTableUsers = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlUser);
                        const resultData = response.data.results;

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
                            data: 'maintenance',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: 'id_user',
                            render: (data, type, row, meta) => {
                                return data;
                            },
                        }, {
                            data: {
                                id: 'id'
                            },
                            render: (data, type, row, meta) => {
                                let editUrl = "{{ route('users.edit', ':id') }}".replace(':id',
                                    data.id);
                                return `
                                <div class="flex items-center gap-1">
                                    <a href="${editUrl}" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-lg text-xs text-white">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-xs text-white" onclick="event.preventDefault(); deleteUser('${data.id}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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

            const promiseDataUsers = () => {
                Promise.all([
                        DataTableUsers(),
                    ])
                    .then((response) => {
                        let responseDTS = response[0];
                        dataTableInstance = $('#table-users').DataTable(responseDTS.config);
                        dataTableInitialized = responseDTS.initialized;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataUsers();
        </script>

        <script>
            const deleteUser = async (data) => {
                const message = confirm('Apakah anda yakin akan menghapus perangkat?');
                if (message) {
                    await axios.post(`/users/${data}`, {
                            '_method': 'DELETE',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        })
                        .then((response) => {
                            alert(response.data.message);
                            location.reload();
                        })
                        .catch((error) => {
                            alert('Tidak dapat menghapus petugas!');
                        });
                }
            }
        </script>
    @endpush
</x-app-layout>

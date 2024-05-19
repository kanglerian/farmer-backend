<div id="subdevice-delete-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
        <div class="relative bg-white rounded-3xl shadow">
            <button type="button" onclick="toggleDeleteModal()"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <i class="fa-solid fa-xmark"></i>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-8 space-y-5 text-center">
                <div class="space-y-3">
                    <i class="fa-solid fa-circle-exclamation text-5xl text-gray-300"></i>
                    <h3 id="delete-confirm" class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to
                        delete this product?</h3>
                </div>
                <form action="" method="POST" id="form-delete-subdevice" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-xl text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya, tentu saja
                    </button>
                </form>
                <button type="button" onclick="toggleDeleteModal()"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-xl border border-gray-200 hover:bg-gray-100 hover:text-sky-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak, batal</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        const toggleDeleteModal = (id) => {
            const modal = document.getElementById('subdevice-delete-modal');
            if (modal.classList.contains('hidden')) {
                deleteInfoSubdevice(id);
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        const deleteInfoSubdevice = async (id) => {
            await axios.get(`/api/subdevice/${id}`)
                .then((response) => {
                    const data = response.data.subdevice;
                    document.getElementById('delete-confirm').innerText =
                        `Apakah anda yakin akan menghapus Sub Perangkat ${data.name}?`
                    let urlUpdate = "{{ route('subdevices.destroy', ':id') }}".replace(':id', data.id);
                    document.getElementById('form-delete-subdevice').setAttribute("action", urlUpdate);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    </script>
@endpush

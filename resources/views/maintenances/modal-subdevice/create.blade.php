<div id="maintenance-create-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
        <!-- Modal content -->
        <div class="w-full relative bg-white rounded-2xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Perawatan
                </h3>
                <button type="button" onclick="toggleModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <i class="fa-solid fa-xmark"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('maintenances.store') }}" class="w-full p-6">
                @csrf
                <div class="w-full grid gap-4 mb-4 grid-cols-1">
                    <input type="hidden" name="id_subdevice" id="id_subdevice" value="{{ $subdevice->id }}">
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal" required />
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
                        <i class="fa-solid fa-plus"></i>
                        Tambah Perawatan
                    </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        const toggleModal = () => {
            const modal = document.getElementById('maintenance-create-modal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
@endpush

<div id="subdevice-create-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="relative flex justify-center items-center h-screen p-4 w-full max-w-md mx-auto max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
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
                    <input type="hidden" name="id_device" id="id_device" value="{{ $device->id }}">
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
@push('scripts')
    <script>
        const toggleModal = () => {
            const modal = document.getElementById('subdevice-create-modal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
@endpush

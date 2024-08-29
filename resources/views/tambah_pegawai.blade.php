<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tampilkan Pesan Error Jika Ada -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded-lg mb-6 shadow-md">
                            <strong class="text-lg font-semibold">Oops! Ada kesalahan:</strong>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/simpan-pegawai" method="post" class="flex flex-col space-y-4">
                        @csrf

                        <x-bladewind::input name="nama"
                            placeholder="Nama"
                            show_placeholder_always="true"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                        <x-bladewind::input name="nip"
                            placeholder="NIP"
                            show_placeholder_always="true"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                        <x-bladewind::input name="nomor_handphone"
                            placeholder="Nomor Handphone"
                            show_placeholder_always="true"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                        <x-bladewind::input name="email"
                            placeholder="Email"
                            show_placeholder_always="true"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                        <x-bladewind::input name="jabatan"
                            placeholder="Jabatan"
                            show_placeholder_always="true"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" />

                        <div class="flex gap-4 mt-6">
                            <x-bladewind::button can_submit="true" color="green" class="px-6 py-3 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                SUBMIT
                            </x-bladewind::button>
                            <x-bladewind::button color="red" onclick="window.history.back()" class="px-6 py-3 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                BATAL
                            </x-bladewind::button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

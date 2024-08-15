<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Menampilkan Pesan Error Jika Ada -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tamu.update', $tamu->id) }}" method="post" class="formulir-tamu">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $tamu->nama) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="mb-4">
                            <label for="nomor_handphone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">No HP</label>
                            <input type="text" id="nomor_handphone" name="nomor_handphone" value="{{ old('nomor_handphone', $tamu->nomor_handphone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $tamu->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="mb-4">
                            <label for="keperluan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Keperluan</label>
                            <input type="text" id="keperluan" name="keperluan" value="{{ old('keperluan', $tamu->keperluan) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="mb-4">
                            <label for="nip" class="block text-sm font-medium text-gray-700 dark:text-gray-200">NIP</label>
                            <select id="nip" name="nip" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Tentukan Pegawai yang akan ditemui</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item['nip'] }}" {{ $item['nip'] == old('nip', $tamu->nip) ? 'selected' : '' }}>{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit Tamu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
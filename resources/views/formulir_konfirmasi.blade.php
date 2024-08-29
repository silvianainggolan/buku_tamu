<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-bladewind::card compact="true">
                        <div class="flex items-center">
                            <div class="grow pl-2 pt-1">
                                <b>Tamu : {{ $tamu->nama }}</b>
                                <br>
                                <b>Pegawai yang dituju : {{ $tamu->pegawai->nama }}</b>
                                <div class="text-sm">{{ $tamu->nomor_handphone }}</div>
                                <div class="text-sm">{{ $tamu->email }}</div>
                                <div class="text-sm">Keperluan : {{ $tamu->keperluan }}</div>
                            </div>
                            <div>
                                <a href="#">
                                    <svg> ... </svg>
                                </a>
                            </div>
                        </div>
                    </x-bladewind::card>

                    <form action="{{ route('tamu.simpan_konfirmasi', $tamu->id) }}" method="post" class="formulir-tamu">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Konfirmasi?</label>
    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
        <option value="1" {{ old('status', $tamu->status) == 1 ? 'selected' : '' }}>Konfirmasi</option>
        <option value="0" {{ old('status', $tamu->status) == 0 ? 'selected' : '' }}>Belum Dikonfirmasi</option>
    </select>
</div>


                        <div class="mb-4">
                            <label for="tanggal_konfirmasi" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Konfirmasi</label>
                            <input type="date" id="tanggal_konfirmasi" name="tanggal_konfirmasi" value="{{ old('tanggal_konfirmasi') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="mb-4">
                            <label for="waktu_konfirmasi" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Waktu Konfirmasi</label>
                            <input type="time" id="waktu_konfirmasi" name="waktu_konfirmasi" value="{{ old('waktu_konfirmasi') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                       

                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
    Simpan
</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

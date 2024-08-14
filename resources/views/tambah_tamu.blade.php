<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/simpan-tamu" method="post" class="formulir-tamu">
                        @csrf
                        <p>Nama</p>
                        <input type="text" name="nama">
                        <br>
                        <p>Nomor Handphone</p>
                        <input type="text" name="nomor_handphone">
                        <br>
                         <p>Email</p>
                        <input type="text" name="email">
                        <br>
                        <p>Keperluan</p>
                        <input type="text" name="keperluan">
                        <br>
                        <p>NIP</p>
                        <select name="nip">
                            <option value="">Tentukan Pegawai yang akan ditemui</option>
                            @foreach ($pegawai as $item)
                            <option value="{{ $item['nip'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .formulir-tamu input, .formulir-tamu select{
        color: black
    }
</style>

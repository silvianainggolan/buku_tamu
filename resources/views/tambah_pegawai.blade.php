<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/simpan-pegawai" method="post" class="formulir-pegawai">
                        @csrf
                        <p>Nama</p>
                        <input type="text" name="nama">
                        <br>
                        <p>NIP</p>
                        <input type="text" name="nip">
                        <br>
                        <p>No HP</p>
                        <input type="text" name="nomor_handphone">
                        <br>
                        <p>Email</p>
                        <input type="text" name="email">
                        <br>
                        <p>Jabatan</p>
                        <input type="text" name="jabatan">
                        <br>
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .formulir-pegawai input{
        color: black
    }
</style>

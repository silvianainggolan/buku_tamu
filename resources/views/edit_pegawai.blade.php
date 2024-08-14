<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pegawai') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="color: black;">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post" class="formulir-pegawai">
                        @csrf
                        <p style="color: white;">Nama</p>
                        <input type="text" name="nama" value="{{$pegawai -> nama}}">
                        <br>
                        <p style="color: white;">NIP</p>
                        <input type="text" name="nip" value="{{$pegawai -> nip}}">
                        <br>
                        <p style="color: white;">No HP</p>
                        <input type="text" name="nomor_handphone"value="{{$pegawai -> nomor_handphone}}">
                        <br>
                        <p style="color: white;">Email</p>
                        <input type="email" name="email" value="{{$pegawai -> email}}">
                        <br>
                        <p style="color: white;">Jabatan</p>
                        <input type="text" name="jabatan" value="{{$pegawai -> jabatan}}">
                        <br>
                        <button type="submit" style="color: white;">Edit Pegawai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="/tambah-pegawai">Tambah Pegawai</a>

                   <table class="tabelku">
                    <tr>
                        <td>Nama</td>
                        <td>NIP</td>
                        <td>No HP</td>
                        <td>Email</td>
                        <td>Jabatan</td>
                    </tr>
                    
                    @foreach ($pegawai as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['nip'] }}</td>
                            <td>{{ $item['nomor_handphone'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['jabatan'] }}</td>
                        </tr>
                    @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .tabelku{
        width: 100%
    }

    .tabelku tr td{
        border: 1px #ddd solid;
        padding: 4px
    }
</style>

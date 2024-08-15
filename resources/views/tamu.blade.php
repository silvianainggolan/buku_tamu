<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="/tambah-tamu" class="bl-button">Tambah Tamu</a>
       
                    <x-bladewind::table>
                        <x-slot name="header">
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Handphone</th>
                            <th>Email</th>
                            <th>Keperluan</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                        </x-slot>
                        
                        @foreach ($tamu as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['nomor_handphone'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['keperluan'] }}</td>
                                <td>{{ $item['nip'] }}</td>
                                <td>{{ $item['pegawai']['nama'] }}</td>
                            </tr>
                        @endforeach
                    </x-bladewind::table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .bl-button {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        color: white;
        background-color: #4a90e2;
        border: none;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .bl-button:hover {
        background-color: #357abd;
    }
</style>

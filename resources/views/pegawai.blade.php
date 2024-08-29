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
                    
                    <!-- Tambahkan bagian ini untuk menampilkan pesan sukses atau error -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Akhir dari bagian pesan sukses atau error -->

                    <a href="{{ route('pegawai.tambah') }}">
                        <x-bladewind::button color="green">TAMBAH</x-bladewind::button>
                    </a>

                    <form method="GET" action="{{ route('pegawai') }}" class="my-4 flex">
                        <input
                            name="search"
                            type="text"
                            placeholder="Cari berdasarkan nama, no handphone, email..."
                            value="{{ request('search') }}"
                            style="color: black;" 
                            class="flex-1 mr-2 border border-gray-300 rounded px-3 py-2"
                        />
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">
                            Cari
                        </button>
                    </form>

                    <x-bladewind::table>
                        <x-slot name="header">
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </x-slot>
                        @foreach ($pegawai as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['nip'] }}</td>
                            <td>{{ $item['nomor_handphone'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['jabatan'] }}</td>
                            <td>
                                <a href="{{ route('pegawai.edit', $item['id']) }}" class="btn btn-sm btn-primary"><x-bladewind::button color="yellow">EDIT</x-bladewind::button></a>
                                @if($item['jumlah_terjadwal'] == 0)
                                <form action="{{ route('pegawai.hapus', $item['id']) }}" method="POST" style="display:inline-block;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <x-bladewind::button type="button" color="red" class="delete-btn">HAPUS</x-bladewind::button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </x-bladewind::table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

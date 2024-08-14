<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('admins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
        <h2>TABEL ADMIN</h2>

        <a href="{{route('admins.create')}}">
                        <x-bladewind::button color="green">TAMBAH</x-bladewind::button>
                    </a>
                    </a>
                    <x-bladewind::table>
                        <x-slot name="header">
                            <th>Nama</th>
                            <th>email</th>
                            <th>password</th>
                           
                        </x-slot>
                        @foreach ($admins as $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['pasword'] }}</td>
                          


                                <a href="{{ route('admin.edit', $item['id']) }}" class="btn btn-sm btn-primary"><x-bladewind::button color="yellow">EDIT</x-bladewind::button></a>
                                <form action="{{ route('admin.hapus', $item['id']) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <x-bladewind::button can_submit="true" color="red" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</x-bladewind::button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </x-bladewind::table>

                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
                    

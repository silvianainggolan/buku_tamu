<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admins') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">TABEL ADMIN</h2>

                    <a href="{{ route('admins.create') }}">
                        <x-bladewind::button color="green">TAMBAH</x-bladewind::button>
                    </a>

                    <x-bladewind::table class="mt-4">
                        <x-slot name="header">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                        </x-slot>

                        @foreach ($admins as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>
                                    <a href="{{ route('admins.edit', $item['id']) }}">
                                        <x-bladewind::button color="yellow">EDIT</x-bladewind::button>
                                    </a>
                                    @if ($logged_user->id != $item['id'])
                                        <form action="{{ route('admins.hapus', $item['id']) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <x-bladewind::button can_submit="true" color="red" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</x-bladewind::button>
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

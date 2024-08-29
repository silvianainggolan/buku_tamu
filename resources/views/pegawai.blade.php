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
                            class="flex-1 mr-2 border border-gray-300 rounded px-3 py-2"
                        />
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Cari
                        </button>
                    </form>

                    <!-- Tabel Pegawai dengan Scroll Horizontal -->
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 bg-gray-50 shadow-md rounded-lg">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">NIP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No HP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pegawai as $index => $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['nama'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['nip'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['nomor_handphone'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['email'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item['jabatan'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pegawai.edit', $item['id']) }}">
                                                <x-bladewind::button color="yellow" class="hover:bg-yellow-500">EDIT</x-bladewind::button>
                                            </a>
                                            @if($item['jumlah_terjadwal'] == 0)
                                            <form action="{{ route('pegawai.hapus', $item['id']) }}" method="POST" style="display:inline-block;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <x-bladewind::button type="button" color="red" class="text-white hover:bg-red-600 delete-btn">HAPUS</x-bladewind::button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 flex items-center justify-between">
                        {{ $pegawai->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert JavaScript Library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom SweetAlert JavaScript for Delete Confirmation -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');
                swal({
                    title: "Apakah Anda yakin ingin menghapus?",
                    text: "Data ini tidak dapat dipulihkan setelah dihapus.",
                    icon: "warning",
                    buttons: {
                        cancel: "Batal",
                        confirm: {
                            text: "Hapus",
                            value: true,
                            visible: true,
                            className: "swal-button--confirm",
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                    closeOnClickOutside: false
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

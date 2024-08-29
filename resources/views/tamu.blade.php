<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Pesan Sukses atau Error -->
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
                    <!-- Akhir dari Pesan Sukses atau Error -->

                    <!-- Tombol Tambah Tamu -->
                    <div class="mb-4">
                        <a href="{{ route('tamu.tambah') }}">
                            <x-bladewind::button color="green" class="hover:bg-green-700">TAMBAH</x-bladewind::button>
                        </a>
                    </div>

                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('tamu') }}" class="my-4 flex items-center space-x-2">
                        <input
                            name="search"
                            type="text"
                            placeholder="Cari berdasarkan nama, no handphone, email..."
                            value="{{ request('search') }}"
                            class="flex-1 border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cari
                        </button>
                    </form>

                    <!-- Tabel Tamu dengan Scroll Horizontal -->
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 bg-gray-50 shadow-md rounded-lg">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Handphone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keperluan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pegawai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal / Waktu Permohonan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal / Waktu Konfirmasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($tamu as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->status == 0)
                                            <x-bladewind::tag label="Belum Dikonfirmasi" color="red" />
                                        @else
                                            <x-bladewind::tag label="Dikonfirmasi" color="green" />
                                        @endif
                                        @if (isset($item->pesan))
                                            <br>
                                            <small>{{ $item->pesan }}</small>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->nomor_handphone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->keperluan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->nip }}<br>{{ $item->pegawai->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal_berkunjung }} <br>{{ $item->jam_berkunjung }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal_konfirmasi }} <br>{{ $item->waktu_konfirmasi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tamu.konfirmasi', $item->id) }}">
                                                <x-bladewind::button color="green" class="hover:bg-green-700">KONFIRMASI</x-bladewind::button>
                                            </a>
                                            <a href="{{ route('tamu.edit', $item->id) }}">
                                                <x-bladewind::button color="yellow" class="hover:bg-yellow-500">EDIT</x-bladewind::button>
                                            </a>
                                            <form action="{{ route('tamu.hapus', $item->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <x-bladewind::button type="button" color="red" class="text-white hover:bg-red-600 delete-btn">HAPUS</x-bladewind::button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center px-6 py-4">Tidak ada data yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $tamu->links('pagination::tailwind') }}
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

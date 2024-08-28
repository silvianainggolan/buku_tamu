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
                    <!-- Tombol Tambah Tamu -->
                    <x-bladewind::button color="purple" tag="a" href="{{ route('tamu.tambah') }}">
                        Tambah Tamu
                    </x-bladewind::button>

                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('tamu') }}" class="my-4 flex">
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

                    <!-- Tabel Tamu -->
                    <x-bladewind::table>
                        <x-slot name="header">
                            <th>No</th>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>No Handphone</th>
                            <th>Email</th>
                            <th>Keperluan</th>
                            <th>NIP</th>
                            <th>waktu</th>
                            <th>tanggal</th>
                        </x-slot>
                        
                        @forelse ($tamu as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
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
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nomor_handphone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->keperluan }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->waktu_konfirmasi }}</td>
                                <td>{{ $item->tanggal_konfirmasi }}</td>
                                <td>{{ $item->tahun->nama ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('tamu.konfirmasi', $item->id) }}" class="btn btn-sm btn-primary">
                                        <x-bladewind::button color="green">KONFIRMASI</x-bladewind::button>
                                    </a>
                                    <a href="{{ route('tamu.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <x-bladewind::button color="yellow">EDIT</x-bladewind::button>
                                    </a>
                                    <!-- Custom Delete Form -->
                                    <form action="{{ route('tamu.hapus', $item->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <x-bladewind::button color="red" class="delete-btn" data-id="{{ $item->id }}">HAPUS</x-bladewind::button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </x-bladewind::table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $tamu->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert CSS Customization -->
    <style>
        .swal-modal {
            font-family: sans-serif;
        }

        .swal-text {
            text-align: center;
        }
    </style>

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

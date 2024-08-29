<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/simpan-tamu" method="post" class="formulir-tamu">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_handphone">Nomor Handphone:</label>
                            <input type="text" id="nomor_handphone" name="nomor_handphone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="keperluan">Keperluan:</label>
                            <input type="text" id="keperluan" name="keperluan" required>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <select id="nip" name="nip" required>
                                <option value="">Tentukan Pegawai yang akan ditemui</option>
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item['nip'] }}">{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
    <label for="tanggal_berkunjung">Tanggal Berkunjung:</label>
    <input type="date" name="tanggal_berkunjung" id="tanggal_berkunjung" class="form-control" value="{{ old('tanggal_berkunjung', $tamu->tanggal_berkunjung ?? '') }}" required>
</div>
<div class="form-group">
    <label for="jam_berkunjung">Jam Berkunjung:</label>
    <input type="time" name="jam_berkunjung" id="jam_berkunjung" class="form-control" value="{{ old('jam_berkunjung', $tamu->jam_berkunjung ?? '') }}" required>
</div>

                       
                        <x-bladewind::button can_submit="true" color="green">SIMPAN</x-bladewind::button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .formulir-tamu {
        max-width: 600px;
        margin: auto;
        background-color: #ffffff; /* White background for the form */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #4a90e2;
        outline: none;
    }

    .submit-btn {
        background-color: #4a90e2;
        color: #fff;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .submit-btn:hover {
        background-color: #357abd;
    }
</style>

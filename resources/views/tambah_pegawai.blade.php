<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/simpan-pegawai" method="post" class="formulir-pegawai">
                        @csrf
                        <x-bladewind::input name="nama"
                            placeholder="Nama "
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="nip"
                            placeholder="NIP"
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="nomor_handphone"
                            placeholder="Nomor Handphone"
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="email"
                            placeholder="Email"
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="jabatan"
                            placeholder="Jabatan"
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        
                        <div class="flex gap-4">
                            <x-bladewind::button can_submit="true" color="green">SUBMIT</x-bladewind::button>
                            <x-bladewind::button color="red" onclick="window.history.back()">BATAL</x-bladewind::button>

                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
<<<<<<< HEAD
    .formulir-pegawai input{
        color: black
    }
=======
    .input-custom-width {
        max-width: 400px; 
        width: 100%;
    }

    .formulir-pegawai input {
        color: black;
    }
>>>>>>> 0b7933979dc50cf086e3bb2e20b6ec285bf19394
</style>

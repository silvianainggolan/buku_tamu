<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pegawai') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="color: black;">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post" class="formulir-pegawai">
                        @csrf
                        <x-bladewind::input name="nama"
                            label="Nama"
                            value="{{$pegawai->nama}}"
                            placeholder=""
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="nip"
                            label="NIP"
                            value="{{$pegawai->nip}}"
                            placeholder=""
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="nomor_handphone"
                            label="Nomor HP"
                            value="{{$pegawai->nomor_handphone}}"
                            placeholder=""
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="email"
                            label="Email"
                            value="{{$pegawai->email}}"
                            placeholder=""
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::input name="jabatan"
                            label="Jabatan"
                            value="{{$pegawai->jabatan}}"
                            placeholder=""
                            show_placeholder_always="true"
                            class="input-custom-width" />
                        <br>
                        <x-bladewind::button can_submit="true" color="yellow">EDIT</x-bladewind::button>
                        <x-bladewind::button color="red" onclick="window.history.back()">BATAL</x-bladewind::button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
.input-custom-width {
    max-width: 400px; 
    width: 100%;
}
</style>

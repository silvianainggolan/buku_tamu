<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit admin') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="color: black;">
                    <form action="{{ route('admins.create', $admins->id) }}" method="post" class="formulir-admin">
                        @csrf
                        <p style="color: white;">Nama</p>
                        <input type="text" name="nama" value="{{$admins -> nama}}">
                        <br>
                        <p style="color: white;">email</p>
                        <input type="text" name="nip" value="{{$admins -> nip}}">
                        <br>
                        <p style="color: white;">password</p>
                        <input type="text" name="nomor_handphone"value="{{$admins -> password}}">
                        <br>
                        
                        <button type="submit" style="color: white;">Edit admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
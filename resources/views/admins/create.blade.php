<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ADMIN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admins.store') }}" method="post" class="formulir-admin">
                        @csrf
                        <p>Nama</p>
                        <input type="text" name="name">
                        <br>
                        <p>Email</p>
                        <input type="text" name="email">
                        <br>
                        <p>Password</p>
                        <input type="password" name="password">
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
    .formulir-admin input{
        color: black
    }
</style>

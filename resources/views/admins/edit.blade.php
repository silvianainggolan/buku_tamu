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
                    <form action="{{ route('admins.update', $admins->id) }}" method="post" class="formulir-admin">
                        @csrf
                        @method('PUT')
                        <p style="color: white;">Nama</p>
                        <input type="text" name="name" value="{{$admins->name}}">
                        <br>
                        <p style="color: white;">email</p>
                        <input type="text" name="email" value="{{$admins->email}}">
                        <br>
                        <p style="color: white;">password</p>
                        <input type="password" name="password" value="">
                        <br>
                    
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring-2 focus:ring-yellow-500 active:bg-blue-600 transition ease-in-out duration-150">
                        edit admin
                    </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
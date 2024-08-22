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
                        
                        <button type="submit" style="
    color: white; 
    background-color: #28a745; 
    padding: 10px 20px; 
    border-radius: 5px; 
    border: none; 
    cursor: pointer; 
    transition: 0.3s;
">
    Edit Admin
</button>

<style>
    button:hover {
        background-color: #218838;
    }
</style>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
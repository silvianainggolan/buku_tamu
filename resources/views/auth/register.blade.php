<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-16 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-center text-2xl font-semibold mb-6">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="('Name')" />
                <x-text-input id="name" class="block mt-1 w-full border border-gray-300 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <div class="flex space-x-4">
                    <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600">
                        {{ __('REGISTER') }}
                    </button>
                    <button type="button" onclick="history.back()" class="px-6 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600">
                        {{ __('CANCEL') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
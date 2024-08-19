<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-white">
        <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-sm border border-gray-200">
            <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">Login</h2>

            <!-- Session Status -->
            @if (session('status'))
                <x-bladewind::alert type="info" show_close_icon="false" class="mb-4">
                    {{ session('status') }}
                </x-bladewind::alert>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-500 hover:underline" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Log in Button -->
                <div class="flex justify-between">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring-2 focus:ring-green-500 active:bg-green-600 transition ease-in-out duration-150">
                        Log in
                    </button>

                    <button type="button" id="cancel-button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring-2 focus:ring-red-500 active:bg-red-600 transition ease-in-out duration-150">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('cancel-button').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</x-guest-layout>
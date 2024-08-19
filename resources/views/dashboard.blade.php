<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("") }}

                    <!-- Google Maps Embed -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Kominfo Dairi Location Map</h3>
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.2285863860175!2d98.31252219999999!3d2.748504599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303037fe21be59bd%3A0x71b38fcf6d5171bf!2sDinas%20Komunikasi%20dan%20Informatika%20Kabupaten%20Dairi!5e0!3m2!1sid!2sid!4v1723747749672!5m2!1sid!2sid" 
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

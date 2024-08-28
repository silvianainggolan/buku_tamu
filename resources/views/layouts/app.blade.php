<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- BladeWind UI Styles -->
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert Custom CSS -->
    <style>
        .swal-modal {
            font-family: sans-serif;
        }

        .swal-text {
            text-align: center;
        }

        .swal-error {
            color: red;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

            {{ $slot }}
        </main>
    </div>

    <!-- Include SweetAlert JavaScript Library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom SweetAlert JavaScript -->
    <script>
        // Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    swal({
                        title: "Apakah Anda yakin ingin menghapus?",
                        text: "Data ini tidak dapat dipulihkan setelah dihapus.",
                        icon: "warning",
                        buttons: {
                            cancel: "Batal",
                            confirm: {
                                text: "Hapus",
                                value: true,
                                visible: true,
                                className: "swal-button--confirm",
                                closeModal: true
                            }
                        },
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
                });
            });
        });

        // Handle success and error messages
        @if (Session::has('success'))
            swal({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: "success",
                buttons: {
                    confirm: "Okay"
                },
                closeOnClickOutside: false
            });
        @elseif (Session::has('error'))
            swal({
                title: "Error",
                text: "{{ Session::get('error') }}",
                icon: "error",
                buttons: {
                    confirm: "Okay"
                },
                className: "swal-error",
                closeOnClickOutside: false
            });
        @endif
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tamu</title>
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group .button-container {
            display: flex;
            justify-content: space-between;
        }
        .form-group button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 48%;
        }
        .form-group button[type="submit"] {
            background-color: #4CAF50;
        }
        .form-group button[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-group button[type="button"] {
            background-color: #f44336;
        }
        .form-group button[type="button"]:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <center><img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Dairi_Regency_Emblem.png" width="100" alt="Logo"></center>
        <h2>Formulir Tamu</h2>
        @if ($message = Session::get('success'))
        <x-bladewind::alert type="success">
            {{ $message }}
        </x-bladewind::alert>
        @endif

        @if ($message = Session::get('error'))
        <x-bladewind::alert type="error">
            {{ $message }}
        </x-bladewind::alert>
        @endif
        <form action="{{ route('tamu.simpan') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nama Tamu:</label>
                <input type="text" id="name" name="nama" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Handphone:</label>
                <input type="tel" id="phone" name="nomor_handphone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="purpose">Keperluan:</label>
                <textarea id="purpose" name="keperluan" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="nip">NIP:</label>
                <select id="nip" name="nip" required>
                    <option value="">Tentukan Pegawai yang akan ditemui</option>
                    @foreach ($pegawai as $item)
                        <option value="{{ $item['nip'] }}">{{ $item['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LcMgCwqAAAAAAHBzhIr3ab6bIs8HXjKeGq82DTl"></div>
            </div>
            <div class="form-group button-container">
                <button type="submit">Submit</button>
                <button type="button" onclick="window.location.href='{{ url('/') }}'">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            if(response.length == 0) { 
                // reCAPTCHA belum dicentang
                alert('Tolong selesaikan reCAPTCHA');
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    </script>
</body>
</html>

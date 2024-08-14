<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tamu</title>
    
    <style>
        body {
            
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .bold-text {
            font-weight: bold; 
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
  <center>  <img class="h-8 w-8 rounded-full" src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Dairi_Regency_Emblem.png" width="100"></center>
        <h2>Formulir Tamu</h2>
        <form action="{{ route('tamu.simpan') }}" method="post">
        @csrf
            <b>
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
                <label for="employee-id">Nomor Induk Pegawai:</label>
                <input type="text" id="employee-id" name="nip" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
    </b>
    
            </div>
        </form>
    </div>
</body>
</html>

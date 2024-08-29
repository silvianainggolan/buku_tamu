<!DOCTYPE html>
<html>
<head>
    <title>EMail</title>
</head>
<body>
    <h3>{{ $data['name'] }}</h3>
    
   
    <p>
    Terhormat Bapak/Ibu {{ $data['tamu']['nama'] }},<br>

    Kami ingin mengingatkan Anda mengenai kunjungan yang telah dijadwalkan  pada:
    <br>
    Tanggal: {{ $data ['tamu']['tanggal_berkunjung'] }},
    <br>
    Waktu: {{ $data['tamu']['jam_berkunjung'] }}
    <br>
    

    Mohon pastikan Anda tiba tepat waktu. Jika ada perubahan rencana, silakan hubungi kami untuk mengatur ulang jadwal.

    Kami menantikan kedatangan Anda.
    <br>

    Hormat kami
    
</p>
</body>
</html>
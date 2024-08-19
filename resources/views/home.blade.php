<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
            background: linear-gradient(to bottom right, #2C3E50, #4CA1AF);
        }

        .navbar {
            background-color: rgba(44, 62, 80, 0.9);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2;
        }

        .navbar .nav-link {
            color: #f8f9fa;
            font-weight: 600;
            font-size: 1.1rem;
            font-family: 'Roboto Slab', serif;
        }

        .navbar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .content-container {
            position: relative;
            text-align: center;
            margin-top: 80px;
            z-index: 1;
        }

        .content-container h1 {
            font-size: 4rem;
            font-weight: 600;
            text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.7);
            font-family: 'Roboto Slab', serif;
            color: #FFD700;
            animation: fadeIn 2s ease-in-out;
        }

        .content-container h2 {
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 0;
            color: #f0f0f0;
            font-family: 'Raleway', sans-serif;
            animation: slideIn 1.5s ease-in-out;
        }

        .content-container h6 {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 40px;
            color: #dcdcdc;
            font-family: 'Raleway', sans-serif;
        }

        .btn-tamu {
            padding: 15px 50px;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #FF5733, #C70039);
            color: #fff;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            text-decoration: none;
            display: inline-block;
            font-family: 'Raleway', sans-serif;
        }

        .btn-tamu:hover {
            background: linear-gradient(135deg, #C70039, #FF5733);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
            transform: translateY(-5px);
        }

        .footer {
            padding: 15px 0;
            background-color: rgba(44, 62, 80, 0.9);
            color: #fff;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-family: 'Raleway', sans-serif;
        }

        .footer a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <ul class="nav nav-pills ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="login">ADMIN</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container content-container">
        <h1>BUKU TAMU</h1>
        <h2>DINAS KOMUNIKASI DAN</h2>
        <h2>INFORMATIKA</h2>
        <h6>KAB. DAIRI</h6>

        <!-- Button TAMU -->
        <div>
            <a href="user" class="btn-tamu">TAMU</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Dinas Komunikasi dan Informatika Kab. Dairi | <a href="https://dairikab.go.id">Visit Us</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

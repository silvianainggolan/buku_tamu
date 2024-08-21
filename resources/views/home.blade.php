<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ffffff; /* Set background to white */
        }
        .container h1 {
            font-family: 'Book Antiqua', sans-serif; 
            font-size: 2rem; 
            font-weight: bold; 
            color: #333; /* Darker color for text */
        }

        .container h2 {
            font-family: 'Book Antiqua', sans-serif; 
            font-size: 3rem; 
            font-weight: 600; 
            color: #333; /* Darker color for text */
        }
        .container h6 {
            font-family: 'Book Antiqua', sans-serif; 
            font-size: 1rem; 
            font-weight: 600; 
            color: #555; /* Darker color for small text */
        }
        .nav-pills .nav-link {
            color: #000000; /* Dark color for navigation links */
            font-family: 'Elephant', sans-serif; 
        }

        .nav-pills .nav-link.active {
            color: #000000; 
            background-color: #ffffff; /* Active link with white background */
            border: 2px solid #007bff; /* Add border for better contrast */
        }

        .nav-pills .nav-link:hover {
            background-color: #f8f9fa; /* Light gray hover effect */
        }

        .btn-primary {
            background-color: #007bff; /* Keep the primary blue button */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #004085;
        }
    </style>
</head>
<body>
    <!-- Navbar with light background -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f8f9fa;">
        <div class="container">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="login">ADMIN</a>
                </li>
            </ul>
        </div>
    </nav>
  
    <!-- Main content -->
    <div class="container mt-4 text-center">
        <h1>BUKU TAMU</h1>
        <h2>DINAS KOMUNIKASI DAN</h2>
        <h2>INFORMATIKA</h2>
        <h6>KAB. DAIRI</h6>

        <!-- Button for TAMU -->
        <div class="container mt-4">
            <a href="user" class="btn btn-primary btn-lg">TAMU</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

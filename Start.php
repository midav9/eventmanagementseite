<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllEvents - Dein Portal für unvergessliche Momente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; 
        }
        .navbar {
            background-color: #343a40 !important; /
            box-shadow: 0 2px 4px rgba(0,0,0,.1); 
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; 
        }
        .nav-link.active {
            font-weight: 700;
        }
        .hero-background {
            background-image: url('img/events-e1530189317364.webp');
            background-size: cover;
            background-position: center;
            color: white; 
            height: 450px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative; 
            overflow: hidden; 
        }
        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1;
        }
        .hero-background > * {
            z-index: 2; 
        }
        .hero-background h1 {
            font-weight: 700;
            margin-bottom: 15px;
        }
        .hero-background .lead {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }
        .hero-background .btn-primary {
            background-color: #007bff; 
            border-color: #007bff;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px; 
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .hero-background .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .card {
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,.05); 
            transition: transform 0.3s ease-in-out; 
            margin-bottom: 30px; 
        }
        .card:hover {
            transform: translateY(-5px); 
        }
        .card-body {
            padding: 30px;
        }
        .card h2 {
            color: #343a40;
            font-size: 1.75rem;
            margin-bottom: 15px;
        }
        .card p {
            color: #6c757d;
            line-height: 1.6;
        }
        .card .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 50px;
            padding: 8px 20px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .card .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        footer {
            background-color: #343a40; 
            color: #ffffff;
            padding: 30px 0; 
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">AllEvents</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Start<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="User.php">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ourselfs.php">Über uns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login.php">Registrieren</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="jumbotron text-center flex-grow-1 hero-background">
        <h1 class="display-4">Willkommen bei AllEvents!</h1>
        <p class="lead">Momente gestalten, Erinnerungen schaffen.</p>
        <a class="btn btn-primary btn-lg" href="events.php" role="button">Events entdecken</a>
    </div>

    <div class="container flex-grow-1">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Events in deiner Nähe</h2>
                        <p class="card-text">Keine Lust auf lange Strecken? Hier finden Sie spannende Events direkt in Ihrer Umgebung!</p>
                        <a class="btn btn-secondary" href="http://localhost/events.php?suchbegriff=Dresden&kategorie=&datum=" role="button">Anzeigen</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Große Events</h2>
                        <p class="card-text">Erleben Sie die größten Events in Deutschland und Europaweit!ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ</p>
                        <a class="btn btn-secondary" href="#" role="button">Anzeigen</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Unser Empfehlungen</h2>
                        <p class="card-text">Hier finden Sie personalisierte Empfehlungen basierend auf Ihren Interessen und Aktivitäten.</p>
                        <a class="btn btn-secondary" href="http://localhost/events.php" role="button">Anzeigen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
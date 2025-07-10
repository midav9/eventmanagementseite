<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Über uns - AllEvents</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #343a40 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1); 
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; 
        }
        .nav-link.active {
            font-weight: 700;
        }
        .hero-background {
            background-image: url('img/1000_F_216946587_rmug8FCNgpDCPQlstiCJ0CAXJ2sqPRU7.jpg'); 
            background-size: cover;
            background-position: center;
            color: white; 
            height: 350px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
            padding: 20px;
        }
        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6); 
            z-index: 1;
        }
        .hero-background > * {
            z-index: 2;
        }
        .hero-background h1 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 3.5rem;
        }
        .hero-background p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto;
        }
        .content-section {
            padding: 60px 0; 
            background-color: #ffffff; 
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,.05);
            margin: 40px auto; 
            max-width: 960px; 
        }
        .content-section h2 {
            color: #343a40;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
        }
        .content-section p {
            color: #6c757d;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .content-section ul {
            list-style: none;
            padding-left: 0;
        }
        .content-section ul li {
            margin-bottom: 10px;
            color: #495057;
            font-size: 1.05rem;
        }
        .content-section ul li::before {
            content: "\2713"; 
            color: #28a745; 
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 30px 0;
            text-align: center;
            margin-top: auto; 
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
                <li class="nav-item">
                    <a class="nav-link" href="Start.php">Start</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="User.php">User</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Über uns<span class="sr-only">(current)</span></a>
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

    <div class="jumbotron hero-background">
        <h1>Über uns</h1>
        <p>Deine Welt der Erlebnisse: Momente gestalten, Erinnerungen schaffen – mit AllEvents.</p>
    </div>

    <div class="container flex-grow-1">
        <div class="content-section">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2>Deine Welt der Erlebnisse mit AllEvents</h2>
                    <p>Willkommen bei **AllEvents**, deinem führenden Portal für unvergessliche Erlebnisse in Deutschland und darüber hinaus! Wir glauben fest daran, dass die schönsten Momente im Leben durch gemeinsame Erlebnisse entstehen. Aus dieser Überzeugung heraus wurde AllEvents im Jahr **2023** in **Dresden, Deutschland**, gegründet. Unser Ziel ist es, Menschen nahtlos mit den Veranstaltungen zu verbinden, die sie lieben, und es Veranstaltern gleichzeitig zu ermöglichen, ihr Publikum effektiv zu erreichen.</p>
                    
                    <h3 class="mt-5 mb-3 text-center" style="color: #343a40; font-weight: 600;">Unsere Mission</h3>
                    <p>Unsere Mission ist es, die Suche nach und das Erleben von Veranstaltungen so **einfach, persönlich und bereichernd wie möglich** zu gestalten. Egal, ob du nach einem intimen Konzert in deiner Nachbarschaft, einem pulsierenden Musikfestival, einer inspirierenden Konferenz oder einem spannenden Sportereignis suchst – AllEvents ist deine zentrale Anlaufstelle. Wir wollen nicht nur Events auflisten, sondern **Erinnerungen schaffen**.</p>

                    <h3 class="mt-5 mb-3 text-center" style="color: #343a40; font-weight: 600;">Was uns auszeichnet</h3>
                    <ul>
                        <li>**Umfassende Auswahl:** Von lokalen Geheimtipps bis zu internationalen Mega-Events – wir decken ein breites Spektrum an Kategorien ab, darunter Musik, Sport, Kunst & Kultur, Business, Familie und vieles mehr.</li>
                        <li>**Benutzerfreundlichkeit:** Unsere intuitive Plattform wurde entwickelt, um dir die Suche und Buchung von Events so einfach wie möglich zu machen. Personalisiere deine Suche und entdecke Veranstaltungen, die perfekt zu deinen Interessen passen.</li>
                        <li>**Fokus auf die Community:** AllEvents ist mehr als nur eine Ticketplattform. Wir fördern eine lebendige Community, in der Event-Liebhaber Empfehlungen teilen, Bewertungen abgeben und sich über ihre Leidenschaften austauschen können.</li>
                        <li>**Unterstützung für Veranstalter:** Wir bieten moderne Tools und umfassende Unterstützung für Veranstalter jeder Größe, um ihre Events erfolgreich zu bewerben, Tickets zu verkaufen und ihr Publikum zu begeistern.</li>
                    </ul>

                    <h3 class="mt-5 mb-3 text-center" style="color: #343a40; font-weight: 600;">Unser Team</h3>
                    <p>Hinter AllEvents steht ein **passioniertes Team aus Event-Enthusiasten, Technologie-Experten und kreativen Köpfen**. Mit unserem Hauptsitz in **Dresden** arbeiten wir täglich daran, unsere Plattform zu verbessern und neue Wege zu finden, wie Menschen unvergessliche Momente erleben können. Wir sind stolz auf unsere Unternehmenskultur, die von **Innovation, Zusammenarbeit und dem Engagement für unsere Nutzer** geprägt ist.</p>

                    <h3 class="mt-5 mb-3 text-center" style="color: #343a40; font-weight: 600;">Unsere Vision für die Zukunft</h3>
                    <p>Wir stellen uns eine Welt vor, in der jeder Mensch Zugang zu den Erlebnissen hat, die sein Leben bereichern. AllEvents wird weiterhin in innovative Technologien investieren und unsere Reichweite ausbauen, um noch mehr Menschen und Veranstalter weltweit zu verbinden. Wir sind bestrebt, der **vertrauenswürdigste Partner** für alle deine Event-Bedürfnisse zu sein und freuen uns darauf, mit dir gemeinsam viele weitere unvergessliche Momente zu schaffen.</p>

                    <p class="text-center mt-5" style="font-style: italic; color: #555;">Vielen Dank, dass du Teil der AllEvents-Community bist!</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-auto">
        <p>&copy; 2025 AllEvents. Alle Rechte vorbehalten.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event-Registrierung & Ticketverkauf für Unternehmen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .header {
            background-color: #0056b3; 
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .section-title {
            color: #0056b3;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }
        .feature-card {
            background-color: #ffffff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            min-height: 280px; 
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 3.5em;
            color: #007bff;
            margin-bottom: 20px;
        }
        .feature-card h4 {
            color: #0056b3;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .call-to-action-section {
            background-color: #e9f7fe; 
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            margin-top: 50px;
        }
        .call-to-action-section h3 {
            color: #0056b3;
            margin-bottom: 25px;
            font-size: 2em;
        }
        .btn-primary-custom {
            background-color: #28a745; 
            border-color: #28a745;
            font-size: 1.2em;
            padding: 12px 30px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }
        .btn-primary-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .footer {
            background-color: #343a40; 
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Ihr Event-Erfolg beginnt hier!</h1>
        <p>Registrieren Sie Ihre Unternehmens-Events und ermöglichen Sie direkten Ticketverkauf über unsere Plattform.</p>
    </div>

    <div class="container">
        <h2 class="section-title">So funktioniert's: Events registrieren und Tickets verkaufen</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-calendar-alt feature-icon"></i>
                    <h4>1. Event offiziell registrieren</h4>
                    <p>Melden Sie Ihre Konferenzen, Workshops, Messen oder andere Unternehmens-Events einfach und schnell auf unserer Plattform an. Wir führen Sie durch den gesamten Prozess.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-eye feature-icon"></i>
                    <h4>2. Sichtbarkeit für User</h4>
                    <p>Nach der Registrierung wird Ihr Event prominent auf unserer Seite präsentiert. Millionen von Nutzern entdecken hier neue und spannende Veranstaltungen.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="fas fa-ticket-alt feature-icon"></i>
                    <h4>3. Direkter Ticketverkauf</h4>
                    <p>Ihre Kunden können Tickets für Ihr Event direkt auf unserer Plattform erwerben. Wir übernehmen die sichere Abwicklung, damit Sie sich auf Ihr Event konzentrieren können.</p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="call-to-action-section">
            <h3>Bereit, Ihr Event zum Erfolg zu führen?</h3>
            <p class="lead">Nutzen Sie unsere Plattform für maximale Reichweite und einen reibungslosen Ticketverkauf.</p>
            <a href="eventregistrieren.php" class="btn btn-primary-custom btn-lg">Jetzt Event registrieren</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
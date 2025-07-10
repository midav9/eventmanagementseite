<?php
include "dbconnect.php";

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = htmlspecialchars($_POST['name'] ?? '');
    $eventDatum = htmlspecialchars($_POST['datum'] ?? '');
    $eventPlatz = htmlspecialchars($_POST['platz'] ?? '');
    $eventPreis = htmlspecialchars($_POST['preis'] ?? '');
    $eventArt = htmlspecialchars($_POST['art'] ?? '');
    $eventOrganisator = htmlspecialchars($_POST['organisator'] ?? '');
    $eventKategorie = htmlspecialchars($_POST['kategorie'] ?? '');
    $eventKapazitaet = htmlspecialchars($_POST['kapazität'] ?? '');

    $eventBild = null;
    if (isset($_FILES['event_bild']) && $_FILES['event_bild']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['event_bild']['type'] === 'image/jpeg' && $_FILES['event_bild']['size'] <= 2 * 1024 * 1024) {
            $eventBild = file_get_contents($_FILES['event_bild']['tmp_name']);
        } else {
            $message = '<div class="alert alert-danger" role="alert">Bitte nur JPEG-Bilder bis max. 2MB hochladen.</div>';
        }
    }

    if (empty($eventName) || empty($eventDatum) || empty($eventOrganisator)) {
        $message = '<div class="alert alert-danger" role="alert">Bitte füllen Sie alle Pflichtfelder aus (Event-Name, Datum, Organisator).</div>';
    } elseif (isset($_FILES['event_bild']) && $_FILES['event_bild']['error'] !== UPLOAD_ERR_NO_FILE && $eventBild === null) {
    } else {
        $preisDB = !empty($eventPreis) ? (float)$eventPreis : null;
        $kapazitaetDB = !empty($eventKapazitaet) ? (int)$eventKapazitaet : null;
        $initialStatus = 'pending';

if ($eventBild !== null) {
    $stmt = $conn->prepare("INSERT INTO event (name, datum, platz, preis, art, organisator, kategorie, kapazität, status, event_bild) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsssisb", $eventName, $eventDatum, $eventPlatz, $preisDB, $eventArt, $eventOrganisator, $eventKategorie, $kapazitaetDB, $initialStatus, $eventBild);
    if ($eventBild !== null) {
        $stmt->send_long_data(9, $eventBild);
    }
} else {
    $stmt = $conn->prepare("INSERT INTO event (name, datum, platz, preis, art, organisator, kategorie, kapazität, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsssis", $eventName, $eventDatum, $eventPlatz, $preisDB, $eventArt, $eventOrganisator, $eventKategorie, $kapazitaetDB, $initialStatus);
}
        if ($stmt->execute()) {
            $message = '<div class="alert alert-success" role="alert">Ihr Event wurde erfolgreich registriert! Wir werden uns bald bei Ihnen melden.</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Fehler bei der Registrierung des Events: ' . $stmt->error . '</div>';
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registrieren</title>
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
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 30px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            padding: 15px 20px;
            font-size: 1.5em;
            margin: -30px -30px 30px -30px;
            text-align: center;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-submit {
            background-color: #28a745;
            border-color: #28a745;
            font-size: 1.1em;
            padding: 10px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .btn-submit:hover {
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
        .back-button-container {
            margin-bottom: 20px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Event registrieren</h1>
        <p>Füllen Sie das Formular aus, um Ihr Event auf unserer Plattform einzustellen.</p>
    </div>

    <div class="container">
        <div class="back-button-container">
            <a href="javascript:history.back()" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Zurück</a>
        </div>
        <div class="card">
            <div class="card-header">
                <i class="fas fa-clipboard-list mr-2"></i> Event-Details eingeben
            </div>
            <div class="card-body">
                <?php echo $message; ?>
                <form action="eventregistrieren.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="name">Event-Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Z.B. Tech-Konferenz 2025" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datum">Datum <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="datum" name="datum" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="platz">Ort / Adresse des Events</label>
                        <input type="text" class="form-control" id="platz" name="platz" placeholder="Z.B. Kongresszentrum Musterstadt, Musterstr. 10">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="art">Art des Events</label>
                            <input type="text" class="form-control" id="art" name="art" placeholder="Z.B. Konferenz, Workshop, Konzert">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kategorie">Kategorie</label>
                            <input type="text" class="form-control" id="kategorie" name="kategorie" placeholder="Z.B. Technologie, Musik, Sport">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="organisator">Name des Organisators / Unternehmens <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="organisator" name="organisator" placeholder="Ihr Firmenname" required>
                    </div>

                    <div class="form-group">
                        <label for="event_bild">Event-Bild (JPEG, max. 2MB)</label>
                        <input type="file" class="form-control-file" id="event_bild" name="event_bild" accept="image/jpeg">
                    </div>

                    <hr class="my-4">

                    <h4>Ticket & Kapazitätsinformationen</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="preis">Ticketpreis (in EUR)</label>
                            <input type="number" step="0.01" class="form-control" id="preis" name="preis" placeholder="Z.B. 29.99">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kapazität">Maximale Kapazität / Anzahl der Tickets</label>
                            <input type="number" class="form-control" id="kapazität" name="kapazität" placeholder="Z.B. 500">
                        </div>
                    </div>

                    <div class="form-group form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="terms_conditions" required>
                        <label class="form-check-label" for="terms_conditions">Ich habe die <a href="agb.php">AGB und Datenschutzbestimmungen</a> gelesen und stimme ihnen zu. <span class="text-danger">*</span></label>
                    </div>
                    <button type="submit" class="btn btn-primary">Event absenden</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
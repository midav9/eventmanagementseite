<?php
include "dbconnect.php"; 

$events = []; 

$where = ["status = 'active'"];
$params = [];
$types = "";

if (!empty($_GET['suchbegriff'])) {
    $where[] = "(name LIKE ? OR platz LIKE ?)";
    $params[] = '%' . $_GET['suchbegriff'] . '%';
    $params[] = '%' . $_GET['suchbegriff'] . '%';
    $types .= "ss";
}
if (!empty($_GET['kategorie'])) {
    $where[] = "kategorie = ?";
    $params[] = $_GET['kategorie'];
    $types .= "s";
}
if (!empty($_GET['datum'])) {
    $where[] = "datum = ?";
    $params[] = $_GET['datum'];
    $types .= "s";
}
if (!empty($_GET['kapazitaet'])) {
    $where[] = "kapazität >= ?";
    $params[] = $_GET['kapazitaet'];
    $types .= "i";
}

$sql = "SELECT event_id, name, datum, platz, preis, art, organisator, kategorie, kapazität, status FROM event";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY datum ASC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
} else {
    echo "Fehler beim Abrufen der Events: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="body.css">
    <title>Unsere Events - Übersicht</title>
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
            padding: 30px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .event-card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .event-card-body {
            padding: 25px;
        }
        .event-card-title {
            font-size: 1.6em;
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 10px;
        }
        .event-info {
            font-size: 0.95em;
            color: #555;
            margin-bottom: 8px;
        }
        .event-info i {
            color: #007bff;
            margin-right: 8px;
        }
        .event-description {
            font-size: 0.9em;
            color: #666;
            margin-top: 15px;
            line-height: 1.6;
        }
        .event-price {
            font-size: 1.4em;
            font-weight: bold;
            color: #28a745;
            margin-top: 15px;
            text-align: right;
        }
        .btn-tickets {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
            font-weight: bold;
            font-size: 1.1em;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
        .btn-tickets:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #333;
        }
        .btn-primary {
            background-color: #18f504ff;
            border-color: #1cf84bff;
            color: green;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .no-events-message {
            text-align: center;
            padding: 50px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            color: #777;
            font-size: 1.2em;
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
        <h1>Aktuelle Events</h1>
        <p>Entdecken Sie spannende Veranstaltungen in Ihrer Nähe und buchen Sie direkt Ihre Tickets!</p>
    </div>

    <div class="container">

        <form method="GET" class="mb-4">
    <div class="form-row">
        <div class="form-group col-md-4">
            <input type="text" name="suchbegriff" class="form-control" placeholder="Eventname oder Ort" value="<?php echo htmlspecialchars($_GET['suchbegriff'] ?? ''); ?>">
        </div>
        <div class="form-group col-md-3">
            <select name="kategorie" class="form-control">
                <option value="">Kategorie wählen</option>
                <option value="Musik" <?php if(($_GET['kategorie'] ?? '') == 'Musik') echo 'selected'; ?>>Musik</option>
                <option value="Technologie" <?php if(($_GET['kategorie'] ?? '') == 'Technologie') echo 'selected'; ?>>Technologie</option>
                <option value="Gaming" <?php if(($_GET['kategorie'] ?? '') == 'Gaming') echo 'selected'; ?>>Gaming</option>
                <option value="Kultur" <?php if(($_GET['kategorie'] ?? '') == 'Kultur') echo 'selected'; ?>>Kultur</option>
                <option value="Sport" <?php if(($_GET['kategorie'] ?? '') == 'Sport') echo 'selected'; ?>>Sport</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <input type="date" name="datum" class="form-control" value="<?php echo htmlspecialchars($_GET['datum'] ?? ''); ?>">
        </div>
        <div class="form-group col-md-2">
            <input type="number" name="kapazitaet" class="form-control" placeholder="Kapazität ab" min="1" value="<?php echo htmlspecialchars($_GET['kapazitaet'] ?? ''); ?>">
        </div>
        <div class="form-group col-md-1">
            <button type="submit" class="btn btn-primary btn-block">Filtern</button>
        </div>
    </div>
</form>
        <?php if (!empty($events)): ?>
            <div class="row">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="event-card flex-fill">
                            <img src="event_image.php?id=<?php echo $event['event_id']; ?>" alt="Event Image">
                            <div class="event-card-body">
                                <h2 class="event-card-title"><?php echo htmlspecialchars($event['name']); ?></h2>
                                <p class="event-info"><i class="fas fa-calendar-alt"></i> Datum: <?php echo date('d.m.Y', strtotime($event['datum'])); ?></p>
                                <p class="event-info"><i class="fas fa-map-marker-alt"></i> Ort: <?php echo htmlspecialchars($event['platz']); ?></p>
                                <p class="event-info"><i class="fas fa-microchip"></i> Kategorie: <?php echo htmlspecialchars($event['kategorie']); ?></p>
                                <p class="event-info"><i class="fas fa-building"></i> Organisator: <?php echo htmlspecialchars($event['organisator']); ?></p>
                                <p class="event-info"><i class="fas fa-tag"></i> Art: <?php echo htmlspecialchars($event['art']); ?></p>
                                <?php if (!is_null($event['kapazität'])): ?>
                                    <p class="event-info"><i class="fas fa-users"></i> Kapazität: <?php echo htmlspecialchars($event['kapazität']); ?></p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <?php if (!is_null($event['preis']) && $event['preis'] > 0): ?>
                                        <p class="event-price"><?php echo number_format($event['preis'], 2, ',', '.'); ?> &euro;</p>
                                        <a class="btn btn-primary" href="#" role="button">Kaufen</a>
                                    <?php else: ?>
                                        <p class="event-price">Kostenlos</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-events-message">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h3>Derzeit keine Events verfügbar.</h3>
                <p>Schauen Sie bald wieder vorbei oder <a href="eventregistrieren.php">registrieren Sie Ihr eigenes Event</a>!</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="darkmode.js"></script>
</body>
</html>
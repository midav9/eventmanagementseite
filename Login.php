<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="body.css">
    <title>AllEvents - Registrierung</title>
    
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
        .hero-background {
            background-image: url('img/ai-generated-concert-crowd-enjoying-live-music-event-photo.jpg');
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
            max-width: 700px; 
            margin: 0 auto;
        }
        .form-container {
            max-width: 650px; 
            margin: 40px auto; 
            background-color: #ffffff; 
            border-radius: 12px; 
            padding: 40px; 
            box-shadow: 0 8px 16px rgba(0,0,0,.1); 
            flex-grow: 1; 
        }
        .form-group label {
            font-weight: 500;
            color: #333;
        }
        .form-control {
            border-radius: 8px; 
            padding: 10px 15px;
            border-color: #ced4da;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn-primary {
            background-color: #007bff; 
            border-color: #007bff;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 50px; 
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%; 
            margin-top: 20px; 
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .invalid-feedback {
            font-size: 0.875em;
        }
        .alert-success {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050; 
            width: auto;
            min-width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<?php
include "dbconnect.php"; 

$errorMsg = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputName = $_POST['inputName'] ?? '';
    $inputEmail4 = $_POST['inputEmail4'] ?? '';
    $inputAge = $_POST['inputAge'] ?? '';
    $inputStrasse = $_POST['inputStrasse'] ?? '';
    $inputPassword4 = $_POST['inputPassword4'] ?? '';
    $inputCity = $_POST['inputCity'] ?? '';
    $inputZip = $_POST['inputZip'] ?? '';
    $inputState = $_POST['inputState'] ?? '';

    if (empty($inputName) || empty($inputEmail4) || empty($inputAge) || empty($inputStrasse) || empty($inputPassword4) || empty($inputCity) || empty($inputZip) || empty($inputState) || $inputState == "Auswählen") {
        $errorMsg = "Bitte alle Felder ausfüllen und ein Bundesland auswählen!";
    } else {
        if (!filter_var($inputEmail4, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "Ungültiges E-Mail-Format.";
        } elseif (strlen($inputPassword4) < 6) { 
            $errorMsg = "Passwort muss mindestens 6 Zeichen lang sein.";
        } elseif (!is_numeric($inputAge) || $inputAge < 1) {
            $errorMsg = "Alter muss eine positive Zahl sein.";
        } elseif (!is_numeric($inputZip) || strlen($inputZip) != 5) { 
            $errorMsg = "Ungültige Postleitzahl.";
        } else {
            $hashedPassword = password_hash($inputPassword4, PASSWORD_DEFAULT);

            $sql = "INSERT INTO kunden (names, email, age, adresse, passwort, stadt, postleitzahl, bundesland) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                $errorMsg = 'Prepare failed: ' . $conn->error;
            } else {
                $stmt->bind_param("ssisssss", $inputName, $inputEmail4, $inputAge, $inputStrasse, $hashedPassword, $inputCity, $inputZip, $inputState);
                if ($stmt->execute()) {
                    $success = true;
                } else {
                    $errorMsg = "Fehler bei der Registrierung: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}
?>

<?php if ($success): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Erfolg!</strong> Ihre Registrierung war erfolgreich. Sie können sich jetzt anmelden.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<script>
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
<?php elseif (!empty($errorMsg)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Fehler!</strong> <?php echo $errorMsg; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>


<div class="jumbotron hero-background">
    <h1>Registrieren</h1>
    <p>Registrieren Sie sich auf unserer Website, um Vorteile, Angebote und die Teilnahme an speziellen Events zu genießen!</p>
</div>

<div class="form-container">
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Max Mustermann" name="inputName" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">E-Mail</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="max.mustermann@example.com" name="inputEmail4" required>
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPassword4">Passwort</label>
                <input type="password" class="form-control" id="inputPassword4" name="inputPassword4" placeholder="Mind. 6 Zeichen" required>
                </div>
            <div class="form-group col-md-6">
                <label for="inputAge">Alter</label>
                <input type="number" class="form-control" id="inputAge" required name="inputAge" placeholder="z.B. 25" min="1">
            </div>
        </div>
        <div class="form-group">
            <label for="inputStrasse">Straße und Hausnummer</label>
            <input type="text" class="form-control" id="inputStrasse" name="inputStrasse" placeholder="Musterstraße 123" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Stadt</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Musterstadt" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Bundesland</label>
                <select id="inputState" class="form-control" name="inputState" required>
                    <option selected value="">Auswählen...</option>
                    <option value="Baden-Württemberg">Baden-Württemberg</option>
                    <option value="Bayern">Bayern</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Brandenburg">Brandenburg</option>
                    <option value="Bremen">Bremen</option>
                    <option value="Hamburg">Hamburg</option>
                    <option value="Hessen">Hessen</option>
                    <option value="Mecklenburg-Vorpommern">Mecklenburg-Vorpommern</option>
                    <option value="Niedersachsen">Niedersachsen</option>
                    <option value="Nordrhein-Westfalen">Nordrhein-Westfalen</option>
                    <option value="Rheinland-Pfalz">Rheinland-Pfalz</option>
                    <option value="Saarland">Saarland</option>
                    <option value="Sachsen-Anhalt">Sachsen-Anhalt</option>
                    <option value="Sachsen">Sachsen</option>
                    <option value="Schleswig-Holstein">Schleswig-Holstein</option>
                    <option value="Thüringen">Thüringen</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">PLZ</label>
                <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="12345" required pattern="[0-9]{5}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Jetzt registrieren</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="darkmode.js"></script>
</body>
</html>
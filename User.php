<?php
session_start();

$passwort = "Admin123";

if (!isset($_SESSION['user_ok'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pw']) && $_POST['pw'] === $passwort) {
        $_SESSION['user_ok'] = true;
        header("Location: User.php");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login erforderlich</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container" style="max-width:400px;margin-top:100px;">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Admin Passwort erforderlich</h3>
                    <form method="post">
                        <div class="form-group">
                            <input type="password" name="pw" class="form-control" placeholder="Passwort" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
include "dbconnect.php";


$sql = "SELECT kunden_id, names, email, age, adresse, passwort, stadt, postleitzahl, bundesland FROM kunden ORDER BY kunden_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundenliste</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
        body {
            background-color: #f8f9fa; 
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .back-button-container {
            margin-bottom: 20px;
            text-align: right; 
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0"><i class="fas fa-users mr-2"></i>Kundenliste</h2>
        </div>
        <div class="card-body">
            <div class="back-button-container">
                <a href="javascript:history.back()" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Zurück</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>kunden_id</th>
                            <th>names</th>
                            <th>email</th>
                            <th>age</th>
                            <th>adresse</th>
                            <th>passwort</th>
                            <th>stadt</th>
                            <th>postleitzahl</th>
                            <th>bundesland</th>
                            <th>volljährig</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if ($result && $result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                                
                                $volljaehrig = ($row['age'] >= 18) ? "Ja" : "Nein";

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['kunden_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['names']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['passwort']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['stadt']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['postleitzahl']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['bundesland']) . "</td>";
                                echo "<td>" . htmlspecialchars($volljaehrig) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                        
                            echo "<tr><td colspan='10' class='text-center'>Keine Kunden gefunden.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
<?php
session_destroy();
?>
</html>

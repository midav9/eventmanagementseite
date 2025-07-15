<?php
session_start();
include "dbconnectadmin.php";

// Logout-Logik
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: User.php");
    exit;
}

if (!isset($_SESSION['user_ok'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adminname'], $_POST['pw'])) {
        $adminname = $_POST['adminname'];
        $pw = $_POST['pw'];
        $stmt = $conn->prepare("SELECT passwort, status, lvl FROM admins WHERE name=? LIMIT 1");
        // Die Spalten heißen: name, passwort, status, lvl
        $stmt->bind_param("s", $adminname);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($dbpw, $status, $lvl);
            $stmt->fetch();
            if ($pw === $dbpw) { // Für produktiv: password_verify($pw, $dbpw)
                $_SESSION['user_ok'] = true;
                $_SESSION['admin_name'] = $adminname;
                $_SESSION['admin_status'] = $status;
                $_SESSION['admin_lvl'] = $lvl;
                header("Location: User.php");
                exit;
            } else {
                $login_error = "Fehler: Falsches Passwort!";
            }
        } else {
            $login_error = "Fehler: Falscher Adminname!";
        }
        $stmt->close();
    }
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <link rel="stylesheet" href="body.css">
        <meta charset="UTF-8">
        <title>Admin Login erforderlich</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container" style="max-width:400px;margin-top:100px;">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Admin Login erforderlich</h3>
                    <?php if (isset($login_error)): ?>
                        <div class="alert alert-danger"><?php echo $login_error; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="adminname" class="form-control" placeholder="Admin Name" required>
                        </div>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_event_id'])) {
    include "dbconnect.php";
    $eventId = (int)$_POST['approve_event_id'];
    $stmt = $conn->prepare("UPDATE event SET status='active' WHERE event_id=?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: User.php");
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
    <div class="back-button-container" style="text-align:right;">
        <a href="User.php?logout=1" class="btn btn-danger"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
    </div>
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


    <?php
    include "dbconnect.php";
    $pendingEvents = [];
    $resultEvents = $conn->query("SELECT event_id, name, datum, platz, organisator, status FROM event WHERE status='pending' ORDER BY datum ASC");
    if ($resultEvents && $resultEvents->num_rows > 0) {
        while($row = $resultEvents->fetch_assoc()) {
            $pendingEvents[] = $row;
        }
    }
    $conn->close();
    ?>
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0"><i class="fas fa-clock mr-2"></i>Ausstehende Events (pending)</h2>
        </div>
        <div class="card-body">
            <?php if (count($pendingEvents) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>event_id</th>
                            <th>Name</th>
                            <th>Datum</th>
                            <th>Ort</th>
                            <th>Organisator</th>
                            <th>Status</th>
                            <th>Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pendingEvents as $event): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($event['event_id']); ?></td>
                            <td><?php echo htmlspecialchars($event['name']); ?></td>
                            <td><?php echo htmlspecialchars($event['datum']); ?></td>
                            <td><?php echo htmlspecialchars($event['platz']); ?></td>
                            <td><?php echo htmlspecialchars($event['organisator']); ?></td>
                            <td><?php echo htmlspecialchars($event['status']); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="approve_event_id" value="<?php echo $event['event_id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Event wirklich freigeben?')">
                                        Approve
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-info mb-0">Keine ausstehenden Events.</div>
            <?php endif; ?>
        </div>
    </div>
    <!-- /Pending Events Liste -->

</div>
<script src="darkmode.js"></script>
</body>
<?php
// session_destroy(); // Entfernt, Logout nur noch über den Button!
?>
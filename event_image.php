<?php
include "dbconnect.php";

if (!isset($_GET['id'])) {
    http_response_code(404);
    exit;
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT event_bild FROM event WHERE event_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($bild);
if ($stmt->fetch() && $bild) {
    header("Content-Type: image/jpeg");
    echo $bild;
} else {
    // Optional: Platzhalterbild ausgeben
    header("Content-Type: image/jpeg");
    readfile("img/placeholder.jpg");
}
$stmt->close();
$conn->close();
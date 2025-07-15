<?php
include "dbconnect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT event_bild FROM event WHERE event_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

$stmt->bind_result($bild);
$stmt->fetch();
$stmt->close();
$conn->close();

if (empty($bild)) {
    http_response_code(404);
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_buffer($finfo, $bild);
finfo_close($finfo);

while (ob_get_level()) ob_end_clean();

header("Content-Type: $mime");
header("Content-Length: " . strlen($bild));
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

echo $bild;
exit;

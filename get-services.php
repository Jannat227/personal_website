<?php
header('Content-Type: application/json');
include 'config.php';

$type = $_GET['type'] ?? '';

if ($type !== 'design' && $type !== 'coding') {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM images WHERE type = ?");
$stmt->bind_param("s", $type);
$stmt->execute();
$result = $stmt->get_result();

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

echo json_encode($services);
?>
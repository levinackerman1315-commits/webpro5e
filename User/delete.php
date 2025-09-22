<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    die("ID tidak diberikan.");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: read_all.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>

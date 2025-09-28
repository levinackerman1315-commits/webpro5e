<?php
include 'connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql)) {
    header("Location: read_all.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
<?php
include 'connect.php';

$sql = "ALTER TABLE users 
        ADD COLUMN IF NOT EXISTS reset_token VARCHAR(64) DEFAULT NULL,
        ADD COLUMN IF NOT EXISTS reset_expires DATETIME DEFAULT NULL";

if ($conn->query($sql) === TRUE) {
    echo "Columns added (or already exist).";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
    
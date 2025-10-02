<?php
// include koneksi — sesuaikan nama file jika berbeda
include 'connect.php';

// buat table sesuai spesifikasi:
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    role VARCHAR(20) NOT NULL,
    status ENUM('active','inactive') NOT NULL DEFAULT 'inactive',
    reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY unique_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created (or already exists).";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

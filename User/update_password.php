<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password !== $confirm_new_password) {
        die("Password baru tidak sama. <a href='read_all.php'>Kembali</a>");
    }

    // Ambil hash password lama dari DB
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($hash_old);
    if (!$stmt->fetch()) {
        $stmt->close();
        $conn->close();
        die("User tidak ditemukan.");
    }
    $stmt->close();

    // Verifikasi password lama
    if (!password_verify($old_password, $hash_old)) {
        $conn->close();
        die("Password lama salah. <a href='read_all.php'>Kembali</a>");
    }

    // Hash password baru dan update
    $hash_new = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hash_new, $id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: read_all.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

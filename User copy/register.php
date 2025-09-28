<?php
include 'connect.php';

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fullname = $_POST['fullname'];

    // 1. Validasi password
    if ($password != $confirm_password) {
        die("❌ Password tidak sama. <a href='form_register.php'>Kembali</a>");
    }

    // 2. Cek username sudah ada
    $check = $conn->query("SELECT id FROM users WHERE username = '$username'");
    if ($check->num_rows > 0) {
        die("❌ Username sudah dipakai. <a href='form_register.php'>Kembali</a>");
    }

    // 3. Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 4. Simpan ke database
    $sql = "INSERT INTO users (username, password, fullname) VALUES ('$username', '$hashed_password', '$fullname')";
    
    if ($conn->query($sql)) {
        echo "✅ User berhasil didaftarkan!";
        header("Location: read_all.php");
        exit;
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>
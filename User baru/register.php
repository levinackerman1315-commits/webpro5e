<?php
include 'connect.php';

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];
    // $status = $_POST['status'];

     // validasi sederhana
    if (empty($username) || empty($password) || empty($fullname)) {
        die("❌ Semua field wajib diisi. <a href='form_register.php'>Kembali</a>");
    }
    // 2. Cek username sudah ada
    $check = $conn->query("SELECT id FROM user WHERE username = '$username'");
    if ($check->num_rows > 0) {
        die("❌ Username sudah dipakai. <a href='form_register.php'>Kembali</a>");
    }

    // 3. Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 4. Simpan ke database
    $sql = "INSERT INTO user (username, password, fullname,role) VALUES ('$username', '$hashed_password', '$fullname','$role')";
    
    if ($conn->query($sql)) {
        echo "✅ User berhasil didaftarkan!";
        exit;
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>
<?php
include 'connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];

    // Validasi input sederhana
    if (empty($id) || empty($role) || empty($fullname)) {
        die("❌ Data tidak lengkap. <a href='form_update_user.php?id=$id'>Kembali</a>");
    }

    // Query update fullname + role + modified
    $sql = "UPDATE user 
            SET fullname = '$fullname',
                role = '$role',
                modified = NOW()
            WHERE id = $id";

    if ($conn->query($sql)) {
        echo "✅ Data berhasil diupdate!";
        header("Location: form_update_user.php?id=$id");
        exit;
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();
?>

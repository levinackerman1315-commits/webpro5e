<?php
include 'connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    
    // 1. Ambil password lama dari database
    // $result = $conn->query("SELECT password FROM user WHERE id = $id");
   $sql = "UPDATE user 
        SET password = '$hashed_password', 
            role = '$role', 
            modified = NOW() 
        WHERE id = $id";
    if ($result->num_rows == 0) {   
        die("❌ User tidak ditemukan. <a href='form_update_password.php'>Kembali ke daftar</a>");
    }
    
    $user = $result->fetch_assoc();
    $stored_password = $user['password'];

    // 2. Verifikasi password lama
    if (!password_verify($old_password, $stored_password)) {
        die("❌ Password lama salah. <a href='form_update_password.php?id=$id'>Coba lagi</a>");
    }

    // 3. Enkripsi password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // 4. Update database
    // $sql = "UPDATE user SET password = '$hashed_password' WHERE id = $id";
    

     $sql = "UPDATE user 
            SET password = '$hashed_password',
                role = '$role',
                fullname = '$fullname',
                modified = NOW()
            WHERE id = $id";

            
    if ($conn->query($sql)) {
        echo "✅ Password berhasil diupdate!";
        header("Location: form_update_password.php?id=$id");
        exit;
    } else {
        echo "❌ Error: " . $conn->error;
    }
}

$conn->close();

?>
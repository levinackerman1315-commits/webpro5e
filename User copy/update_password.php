<?php
// include 'connect.php';

// if ($_POST) {
//     $id = $_POST['id'];
//     $old_password = $_POST['old_password'];
//     $new_password = $_POST['new_password'];
//     $confirm_new_password = $_POST['confirm_new_password'];

//     1. Validasi password baru
//     if ($new_password != $confirm_new_password) {
//         die("❌ Password baru tidak sama. <a href='read_all.php'>Kembali</a>");
//     }

//     2. Ambil password lama dari database
//     $result = $conn->query("SELECT password FROM users WHERE id = $id");
//     if ($result->num_rows == 0) {
//         die("❌ User tidak ditemukan.");
//     }
    
//     $user = $result->fetch_assoc();
//     $stored_password = $user['password'];

//     3. Verifikasi password lama
//     if (!password_verify($old_password, $stored_password)) {
//         die("❌ Password lama salah. <a href='read_all.php'>Kembali</a>");
//     }

//     4. Enkripsi password baru
//     $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

//     5. Update database
//     $sql = "UPDATE users SET password = '$hashed_password' WHERE id = $id";
    
//     if ($conn->query($sql)) {
//         echo "✅ Password berhasil diupdate!";
//         header("Location: read_all.php");
//         exit;
//     } else {
//         echo "❌ Error: " . $conn->error;
//     }
// }

// $conn->close();



include 'connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // 1. Validasi password baru
    if ($new_password != $confirm_new_password) {
        die("❌ Password baru tidak sama. <a href='form_update_password.php?id=$id'>Coba lagi</a>");
    }

    // 2. Ambil password lama dari database
    $result = $conn->query("SELECT password FROM users WHERE id = $id");
    if ($result->num_rows == 0) {
        die("❌ User tidak ditemukan. <a href='form_update_password.php'>Kembali ke daftar</a>");
    }
    
    $user = $result->fetch_assoc();
    $stored_password = $user['password'];

    // 3. Verifikasi password lama
    if (!password_verify($old_password, $stored_password)) {
        die("❌ Password lama salah. <a href='form_update_password.php?id=$id'>Coba lagi</a>");
    }

    // 4. Enkripsi password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // 5. Update database
    $sql = "UPDATE users SET password = '$hashed_password' WHERE id = $id";
    
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
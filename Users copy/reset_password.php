<?php
include 'connect.php';

if ($_POST) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];
    
    // 1. Validasi password
    if ($new_password != $confirm_password) {
        die("❌ Password tidak sama.");
    }
    
    // 2. Cek token valid dan belum expired
    $result = $conn->query("SELECT id, reset_expires FROM users WHERE reset_token = '$token'");
    
    if ($result->num_rows == 0) {
        die("❌ Token tidak valid.");
    }
    
    $user = $result->fetch_assoc();
    
    // 3. Cek expiry time
    if (strtotime($user['reset_expires']) < time()) {
        die("❌ Token sudah kadaluarsa.");
    }
    
    // 4. Enkripsi password baru
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    // 5. Update password dan hapus token
    $conn->query("UPDATE users SET password = '$hash', reset_token = NULL, reset_expires = NULL WHERE id = " . $user['id']);
    
    exit;
}

// Tampilkan form reset
$token = $_GET['token'];
$result = $conn->query("SELECT id, reset_expires FROM users WHERE reset_token = '$token'");

if ($result->num_rows == 0) {
    die("❌ Token tidak valid.");
}

$user = $result->fetch_assoc();

if (strtotime($user['reset_expires']) < time()) {
    die("❌ Token sudah kadaluarsa.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>🔄 Reset Password</h2>
    
    <form method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        
        Password Baru: <br>
        <input type="password" name="new_password" required><br><br>
        
        Konfirmasi Password Baru: <br>
        <input type="password" name="confirm_new_password" required><br><br>
        
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
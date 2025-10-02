<?php
include 'connect.php';

if ($_POST) {
    $username = $_POST['username'];
    
    // 1. Cek user exists
    $result = $conn->query("SELECT id FROM users WHERE username = '$username'");
    
    if ($result->num_rows == 0) {
        $error = "❌ User tidak ditemukan.";
    } else {
        $user = $result->fetch_assoc();
        
        // 2. Generate token
        $token = bin2hex(random_bytes(16));
        $expires = date('Y-m-d H:i:s', time() + 3600); // 1 jam
        
        // 3. Save token
        $conn->query("UPDATE users SET reset_token = '$token', reset_expires = '$expires' WHERE id = " . $user['id']);
        
        // 4. Show reset link
        $reset_link = "reset_password.php?token=$token";
        $message = "✅ Link reset password: <a href='$reset_link'>$reset_link</a><br>⏰ Token berlaku sampai: $expires";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lupa Password</title>
</head>
<body>
    <h2>🔑 Lupa Password</h2>
    
    <?php if (isset($message)): ?>
        <div style="color:green; background:#e8f5e8; padding:15px; margin:10px 0; border-radius:5px;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div style="color:red; background:#ffe8e8; padding:15px; margin:10px 0; border-radius:5px;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <form method="post">
        Username: <br>
        <input type="text" name="username" required><br><br>
        
        <input type="submit" value="Request Reset Password">
    </form>
    
    <p>
        <a href="form_register.php">Register User Baru</a> | 
        <a href="read_all.php">Lihat Semua User</a>
    </p>
</body>
</html>
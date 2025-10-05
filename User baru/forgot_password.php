<?php
include 'connect.php';

if ($_POST) {
    $username = $conn->real_escape_string(trim($_POST['username'] ?? ''));

    if ($username === '') {
        $error = "❌ Masukkan username/email.";
    } else {
        // cek user ada
        $res = $conn->query("SELECT id FROM user WHERE username = '$username'");
        if ($res && $res->num_rows > 0) {
            $u = $res->fetch_assoc();
            $id = $u['id'];

            // generate token dan expiry (1 jam)
            $token = bin2hex(random_bytes(16));
            $expires = date('Y-m-d H:i:s', time() + 3600);

            // simpan token
            $conn->query("UPDATE user SET reset_token = '$token', reset_expires = '$expires' WHERE id = $id");

            // untuk latihan tampilkan link reset (di produksi kirim via email)
            $reset_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                        . "://{$_SERVER['HTTP_HOST']}" . dirname($_SERVER['REQUEST_URI']) . "/reset_password.php?token=$token";

            $message = "✅ Link reset password: <a href='$reset_link'>$reset_link</a><br>⏰ Token berlaku sampai: $expires";
        } else {
            // opsional: untuk keamanan biasanya jangan beri tahu user tidak ditemukan.
            $error = "❌ User tidak ditemukan.";
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Lupa Password</title></head>
<body>
  <h2>🔑 Lupa Password</h2>

  <?php if (!empty($message)): ?>
    <div style="color:green; background:#e8f5e8; padding:10px; border-radius:6px;"><?php echo $message; ?></div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div style="color:red; background:#ffe8e8; padding:10px; border-radius:6px;"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="post" action="">
    Username / Email: <br>
    <input type="text" name="username" required><br><br>
    <input type="submit" value="Request Reset Password">
  </form>

  <p><a href="form_register.php">Register User Baru</a> | <a href="read_all.php">Lihat Semua User</a></p>
</body>
</html>

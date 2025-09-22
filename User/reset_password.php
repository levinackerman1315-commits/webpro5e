<?php
include 'connect.php';

if (!isset($_GET['token']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Token tidak ditemukan.");
}

// Jika form dikirim via POST, proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password !== $confirm_new_password) {
        die("Password baru tidak sama.");
    }

    // Cek token valid dan belum expired
    $stmt = $conn->prepare("SELECT id, reset_expires FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($id, $reset_expires);
    if (!$stmt->fetch()) {
        $stmt->close();
        $conn->close();
        die("Token tidak valid.");
    }
    $stmt->close();

    if (strtotime($reset_expires) < time()) {
        die("Token sudah kadaluarsa.");
    }

    // Update password, hapus token
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
    $stmt->bind_param("si", $hash, $id);
    if ($stmt->execute()) {
        echo "Password berhasil direset. <a href='form_register.php'>Login / Register</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// Jika GET token -> tampilkan form
$token = $_GET['token'];
$stmt = $conn->prepare("SELECT id, reset_expires FROM users WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->bind_result($id, $reset_expires);
if (!$stmt->fetch()) {
    $stmt->close();
    $conn->close();
    die("Token tidak valid.");
}
$stmt->close();

if (strtotime($reset_expires) < time()) {
    die("Token sudah kadaluarsa.");
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Reset Password</title></head>
<body>
  <h2>Reset Password</h2>
  <form action="reset_password.php" method="post">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
      Password Baru: <br> <input type="password" name="new_password" required><br>
      Konfirmasi Password Baru: <br> <input type="password" name="confirm_new_password" required><br><br>
      <input type="submit" value="Reset Password">
  </form>
</body>
</html>

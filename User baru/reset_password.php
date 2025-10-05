<?php
include 'connect.php';

// proses submit reset
if ($_POST) {
    $token = $conn->real_escape_string(trim($_POST['token'] ?? ''));
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_new_password'] ?? '';

    if ($new_password === '' || $confirm_password === '') {
        die("❌ Isi password baru dan konfirmasi.");
    }
    if ($new_password !== $confirm_password) {
        die("❌ Password tidak sama.");
    }

    // cek token
    $res = $conn->query("SELECT id, reset_expires FROM user WHERE reset_token = '$token'");
    if (!$res || $res->num_rows == 0) {
        die("❌ Token tidak valid.");
    }
    $u = $res->fetch_assoc();
    if (strtotime($u['reset_expires']) < time()) {
        die("❌ Token sudah kadaluarsa.");
    }

    // hash & update
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $id = $u['id'];
    $conn->query("UPDATE user SET password = '$hash', reset_token = NULL, reset_expires = NULL, modified = NOW() WHERE id = $id");

    echo "✅ Password berhasil direset. <a href='login.php'>Login</a>";
    exit;
}

// tampilkan form bila lewat link token
$token = isset($_GET['token']) ? $conn->real_escape_string($_GET['token']) : '';
if ($token === '') {
    die("❌ Token tidak ditemukan.");
}
$res = $conn->query("SELECT id, reset_expires FROM user WHERE reset_token = '$token'");
if (!$res || $res->num_rows == 0) {
    die("❌ Token tidak valid.");
}
$u = $res->fetch_assoc();
if (strtotime($u['reset_expires']) < time()) {
    die("❌ Token sudah kadaluarsa.");
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Reset Password</title></head>
<body>
  <h2>🔄 Reset Password</h2>
  <form method="post" action="">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

    Password Baru: <br>
    <input type="password" name="new_password" required><br><br>

    Konfirmasi Password Baru: <br>
    <input type="password" name="confirm_new_password" required><br><br>

    <input type="submit" value="Reset Password">
  </form>
</body>
</html>

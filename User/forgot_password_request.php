<!doctype html>
<html>
<head><meta charset="utf-8"><title>Forgot Password</title></head>
<body>
  <h2>Forgot Password</h2>
  <form action="forgot_password_request.php" method="post">
      Username: <br> <input type="text" name="username" required><br><br>
      <input type="submit" value="Request Reset">
  </form>
  <p><a href="form_register.php">Register</a> | <a href="read_all.php">Daftar User</a></p>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';
    $username = trim($_POST['username']);

    // Cek user
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        echo "<p>User tidak ditemukan.</p>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    // Generate token
    $token = bin2hex(random_bytes(16)); // 32 hex chars
    $expires = date('Y-m-d H:i:s', time() + 3600); // 1 jam dari sekarang

    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE id = ?");
    $stmt->bind_param("ssi", $token, $expires, $id);
    if ($stmt->execute()) {
        // Idealnya kirim email ke user. Untuk tugas: tampilkan link reset.
        $reset_link = "http://localhost/introwebpro/user/reset_password.php?token=" . $token;
        echo "<p>Link reset (seharusnya dikirim via email):</p>";
        echo "<p><a href='{$reset_link}'>{$reset_link}</a></p>";
        echo "<p>Token berlaku sampai: {$expires}</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
    $conn->close();
}
?>
</body>
</html>

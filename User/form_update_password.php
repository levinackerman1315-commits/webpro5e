<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    die("ID tidak diberikan.");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username);
if (!$stmt->fetch()) {
    $stmt->close();
    $conn->close();
    die("User tidak ditemukan.");
}
$stmt->close();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Update Password</title></head>
<body>
  <h2>Update Password untuk <?= htmlspecialchars($username) ?></h2>
  <form action="update_password.php" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
      New Password: <br> <input type="password" name="new_password" required><br>
      Confirm New Password: <br> <input type="password" name="confirm_new_password" required><br><br>
      <input type="submit" value="Update Password">
  </form>
  <p><a href="read_all.php">Kembali</a></p>
</body>
</html>

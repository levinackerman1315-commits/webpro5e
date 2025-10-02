<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Register New User</h2>
  <form action="register.php" method="post">
      Username: <br> <input type="text" name="username" required><br>
      Password: <br> <input type="password" name="password" required><br>
      Confirm Password: <br> <input type="password" name="confirm_password" required><br>
      Fullname: <br> <input type="text" name="fullname" required><br><br>
      <input type="submit" value="Register">
  </form>

  <p><a href="read_all.php">Lihat semua user</a></p>
</body>
</html>

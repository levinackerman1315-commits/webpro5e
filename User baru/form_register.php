<!-- <!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Register New User</h2>
  <form action="register.php" method="post">
      Username: <br> <input type="email" name="username" placeholder="Your Email" required autocomplete="off"><br>
      Password: <br> <input type="password" name="password" required placeholder="minimal 8 character" autocomplete="off"><br>
      Full Name: <br><input type="text" name="fullname" placeholder="Your Name" required><br>
      Role: <br> <select name="role" required> <option value="" disabled selected>-- Choose your role --</option><option value="admin">Admin</option><option value="operator">Operator</option><option value="visitor">Visitor</option>
      </select><br><br> -->
      <!-- Status: <br>  <select name="status" required> <option value="" disabled selected>-- Choose your Status --</option><option value="inactive">Inactive</option><option value="active">Active</option>
      </select><br><br> -->
      <!-- <input type="submit" value="Register">
  </form>

  <p><a href="read_all.php">Lihat semua user</a></p>
</body>
</html> -->

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h2>Register New User</h2>
  <form action="register.php" method="post">
      Username: <br> 
      <input type="email" name="username" id="username" placeholder="Your Email" required autocomplete="off">
      <span id="username-result" style="margin-left:10px; font-weight:bold;"></span>
      <br>

      Password: <br> 
      <input type="password" name="password" required placeholder="minimal 8 character" autocomplete="off"><br>

      Full Name: <br>
      <input type="text" name="fullname" placeholder="Your Name" required><br>

      Role: <br> 
      <select name="role" required>
        <option value="" disabled selected>-- Choose your role --</option>
        <option value="admin">Admin</option>
        <option value="operator">Operator</option>
        <option value="visitor">Visitor</option>
      </select><br><br>

      <input type="submit" value="Register">
  </form>

  <p><a href="read_all.php">Lihat semua user</a></p>

  <script>
    $(document).ready(function(){
        $("#username").on("keyup", function(){
            var username = $(this).val();
            if(username.length > 2){ // minimal 3 karakter baru cek
                $.post("check_username.php", {username: username}, function(data){
                    $("#username-result").html(data);
                });
            } else {
                $("#username-result").html("");
            }
        });
    });
  </script>
</body>
</html>

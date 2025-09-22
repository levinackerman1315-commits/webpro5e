<?php
include 'connect.php';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>List Users</title></head>
<body>
  <h2>Daftar User</h2>
  <p><a href="form_register.php">➕ Register User</a></p>

<?php
$sql = "SELECT id, username, fullname, reg_date FROM users ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='6' cellspacing='0'>
    <tr><th>ID</th><th>Username</th><th>Fullname</th><th>Reg Date</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id']);
        $username = htmlspecialchars($row['username']);
        $fullname = htmlspecialchars($row['fullname']);
        $reg_date = htmlspecialchars($row['reg_date']);

        echo "<tr>
            <td>{$id}</td>
            <td>{$username}</td>
            <td>{$fullname}</td>
            <td>{$reg_date}</td>
            <td>
                <a href='form_update_password.php?id={$id}'>Update Password</a> | 
                <a href='delete.php?id={$id}' onclick=\"return confirm('Yakin hapus user ini?');\">Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Tidak ada user.</p>";
}

$conn->close();
?>

</body>
</html>

<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Users</title>
</head>
<body>
    <h2>Data Semua User</h2>
    <p><a href="form_register.php">➕ Register User Baru</a></p>

    <?php
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='6' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password (Encrypted)</th><th>Full Name</th><th>Registration Date</th><th>Action</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td style='color:red; font-size:12px; font-family:monospace;'>" . $row['password'] . "</td>";
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['reg_date'] . "</td>";
            echo "<td>
                    <a href='form_update_password.php?id=" . $row['id'] . "'>Update Password</a> | 
                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Yakin hapus user ini?\")'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>❌ Tidak ada data user</p>";
    }
    
    $conn->close();
    ?>
</body>
</html>

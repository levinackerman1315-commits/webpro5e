<?php
include 'connect.php';

// VARIABLE UNTUK MENENTUKAN MODE
$user_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$mode = $user_id ? 'single' : 'list';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Password</title>
    <style>
        .container { max-width: 100%; padding: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Password</h2>
        
        <?php if ($mode === 'single'): ?>
            <!-- MODE SINGLE: TAMPILKAN FORM UPDATE UNTUK 1 USER -->
            <?php
            $result = $conn->query("SELECT username,role FROM user WHERE id = $user_id");
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            ?>
                <h3>Update Password untuk: <?php echo htmlspecialchars($user['username']); ?></h3>
                
                <form action="update_password.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                    
                <?php // Tentukan selected sesuai role
                $admin_selected = $operator_selected = $visitor_selected = "";
            if ($user['role'] == 'admin') {
                $admin_selected = "selected";
            } elseif ($user['role'] == 'operator') {
                $operator_selected = "selected";
             } elseif ($user['role'] == 'visitor') {
                $visitor_selected = "selected";
    }
?>


                 Role: <br>
        <select name="role" required>
            <option value="" disabled>-- Choose your role --</option>
            <option value="admin" <?php echo $admin_selected; ?>>Admin</option>
            <option value="operator" <?php echo $operator_selected; ?>>Operator</option>
            <option value="visitor" <?php echo $visitor_selected; ?>>Visitor</option>
        </select><br><br>

             Full Name: <br>
                    <input type="text" name="name" placeholder="Your Full Name" required><br><br>

                    Password Lama: <br>
                    <input type="password" name="old_password" placeholder="Your Old Password" required><br><br>
                    
                    Password Baru: <br>
                    <input type="password" name="new_password" placeholder="Your New Password" required><br><br>
                    
                    Konfirmasi Password Baru: <br>
                    <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required><br><br>
                    
                    <input type="submit" value="Update Password">
                    <a href="form_update_password.php" style="margin-left: 10px;">Lihat Semua User</a>
                </form>
            <?php } else { ?>
                <p style="color: red;">User tidak ditemukan.</p>
                <a href="form_update_password.php">← Kembali ke daftar user</a>
            <?php } ?>
            
        <?php else: ?>
            <!-- MODE LIST: TAMPILKAN DAFTAR USER UNTUK DIPILIH -->
            <h3>Pilih User untuk Update Password:</h3>
            
            <?php
            $sql = "SELECT id, username, fullname FROM user ORDER BY id ASC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<table border='1' cellpadding='6' cellspacing='0'>";
                echo "<tr><th>ID</th><th>Username</th><th>Nama Lengkap</th><th>Aksi</th></tr>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td><a href='form_update_password.php?id=" . $row['id'] . "'>Update Password</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Belum ada user terdaftar.</p>";
            }
            ?>
            
            <p>
                <a href="form_register.php">➕ Tambah User Baru</a> | 
                <a href="read_all.php">📋 Lihat Detail Lengkap</a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>

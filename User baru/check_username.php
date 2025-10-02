<?php
include 'connect.php';

// if (isset($_POST['username'])) {
//     $username = trim($_POST['username']); 
    // Gunakan prepared statement biar aman dan exact
//     $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
//     $stmt->bind_param("s", $username);
//     $stmt->execute();
//     $stmt->store_result();

//     if ($stmt->num_rows > 0) {
//         echo "<span style='color:red'>❌ Username/Email sudah dipakai!</span>";
//     } else {
//         echo "<span style='color:green'>✅ Username/Email tersedia.</span>";
//     }

//     $stmt->close()
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "❌ Username/Email sudah dipakai!";
    } else {
        echo "✅ Username/Email tersedia.";
    }
};
// }


 ?>

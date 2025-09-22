<?php
$prodID = $_POST['id'];
$prodname = $_POST['name'];
$proddesc = $_POST['desc'];
$prodprice = $_POST['price'];

// echo "Product Name: $prodname <br>";
// echo "Product Description: $proddesc <br>";
// echo "Product Price: $prodprice <br>";
include 'connect.php';

$sql = "UPDATE products SET name  = '$prodname', description = '$proddesc', price = '$prodprice' WHERE id = '$prodID'";

if ($conn->query($sql) === TRUE) {
    echo "New record update successfully";
    header(header: 'Location: read_all.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

Create.php
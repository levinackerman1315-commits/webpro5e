<?php
$prodname = $_POST['name'];
$proddesc = $_POST['desc'];
$prodprice = $_POST['price'];

// echo "Product Name: $prodname <br>";
// echo "Product Description: $proddesc <br>";
// echo "Product Price: $prodprice <br>";
include 'connect.php';

$sql = "INSERT INTO products (name, description, price)
VALUES ('$prodname', '$proddesc', '$prodprice')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

Create.php
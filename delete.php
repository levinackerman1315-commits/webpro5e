<?php
include 'connect.php';

$sql= "DELETE FROM products WHERE  id = $_GET[id]";


if ($conn->query($sql) === TRUE) {
    echo "The record delete successfully";
    header(header: 'Location: read_all.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


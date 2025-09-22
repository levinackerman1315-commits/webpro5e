<?php
include 'connect.php';

// $id = $_GET['id'];
//read one record by id
// $sql = "SELECT * FROM products WHERE id = 1";
//read one record by name
// $sql = "SELECT * FROM products WHERE name = 'PowerBank'";
//read one record by price

echo "<br><br>";


$sql = "SELECT * FROM products WHERE id=$_GET[id]"; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();// memungut data dengan menggunakan array asosiatif dna menyimpan di array asosiatif

//view data
// echo"Id: " . $row['id'] . "<br>";
// echo "Product Name: " . $row['name'] . "<br>";
// echo "Product Description: " . $row['description'] . "<br>";
// echo "Product Price: " . $row['price'] . "<br>";
// echo "Created : " . $row['created'] . "<br>";



//view data dalam bentuk tabel
// echo "<table>
// <tr><th>ID</th><th>Name</th><th>Description</th><th>Prices</th><th>created</th>
// <tr><td>" . $row['id'] . "</td> .  <tr><td>" . $row['name'] . "</td> .  <tr><td>" . $row['description'] . "</td> .  <tr><td>" . $row['price'] . "</td> .  <tr><td>" . $row['created'] . "</td> .  
// </tr>
// </table>";
// tampilkan tabel
// echo "<a href = 'form_input_product"

?>




<html>
    <h2>Add New Product</h2>
    <form action="update.php" method="post">
        ID: <br> <input type="text" name="id" value="<?= $row['id']?>"readonly><br>
        Name:  <br> <input type="text" name="name" value = "<?= $row ['name'] ?>"><br> <br>
        <textarea name="desc"><?= $row['description'] ?></textarea> <br>
        Price: <br> <input type="text" name="price" value = "<?= $row ['price'] ?>"><br> <br>
        <input type="submit" value="Update Product">
    </form>
</html> 
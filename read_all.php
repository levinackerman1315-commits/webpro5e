<?php
include 'connect.php';

// $id = $_GET['id'];
//read one record by id
// $sql = "SELECT * FROM products WHERE id = 1";
//read one record by name
// $sql = "SELECT * FROM products WHERE name = 'PowerBank'";
//read one record by price

echo "<br><br>";
echo "<a href='form_input_product.php'>➕ Add Product</a><br><br>";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
echo "<table border='1' cellspacing='0' cellpadding='5'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Created</th>
    <th>Action</th>
    </tr>";
    if ($result->num_rows > 0) {
        
        $no = 1;
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo"<tr>
            
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['created'] . "</td>
                  <td><a href='form_edit_product.php?id=" . $row['id'] . "'>Edit</a> | 
        <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin hapus data ini?');\">Delete</a></td>
                </tr>";
                //loop
                }
                echo"</table>";
} else {
  echo "0 results";// memungut data dengan menggunakan array asosiatif dna menyimpan di array asosiatif
}
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

// tampilkan detail teks
// echo "Id: " . $row['id'] . "<br>";
// echo "Product Name: " . $row['name'] . "<br>";
// echo "Product Description: " . $row['description'] . "<br>";
// echo "Product Price: " . $row['price'] . "<br>";
// echo "Created : " . $row['created'] . "<br>";
$conn->close();
?>

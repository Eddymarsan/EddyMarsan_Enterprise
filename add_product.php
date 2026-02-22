<?php
include "config.php";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $conn->query("INSERT INTO products (product_name,description,price,stock)
                  VALUES ('$name','$desc','$price','$stock')");

    echo "<script>alert('Product Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Add Product</h2>

<form method="POST" onsubmit="return validateProduct()">
    <input type="text" name="name" id="name" placeholder="Product Name" required>
    <input type="text" name="desc" placeholder="Description" required>
    <input type="number" name="price" id="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <button name="add">Add Product</button>
</form>
</div>

<script>
function validateProduct(){
    let price = document.getElementById("price").value;

    if(price <= 0){
        alert("Price must be greater than 0");
        return false;
    }
    return true;
}
</script>

</body>
</html>
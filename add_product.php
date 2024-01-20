<?php
require_once "config.php";
require_once "product.php";

$productHandler = new Product($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Product</h2>
		<a href="tampil_product.php" class="btn btn-success pull-left"> Back </a>
        <form action="index.php" method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="namabarang" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
			 <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
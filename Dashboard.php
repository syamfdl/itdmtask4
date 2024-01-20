<?php
require_once "config.php";
require_once "product.php";

$productHandler = new Product($conn);

// Create Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $productHandler->setNamabarang($_POST['namabarang']);
    $productHandler->setStock($_POST['stock']);
    $productHandler->setHarga($_POST['harga']);
    $productHandler->createProduct();
}

// Read Products
$products = $productHandler->getProducts();

// Update Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $productHandler->setId($_POST['update_id']);
    $productHandler->setNamaBarang($_POST['update_name']);
    $productHandler->setStock($_POST['update_stock']);
    $productHandler->setHarga($_POST['update_harga']);
    $productHandler->updateProduct();
}

// Delete Product
if (isset($_GET['delete'])) {
    $productHandler->setId($_GET['delete']);
    $productHandler->deleteProduct();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Product</title>
    <style>
        /* CSS untuk styling */
        body {
            font-family: Arial, sans-serif;
        }

        .add-icon {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .add-icon:hover {
            background-color: #45a049;
        }

        .plus-icon::before {
            content: '\002B'; /* Unicode karakter untuk plus (+) */
            margin-right: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Products</h2>
            <a href="add_product.php" class="btn btn-success pull-left"><span class="plus-icon"> Add Product</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Terjual</th>
					<th>Laba</th>
					<th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['nama_barang']; ?></td>
                        <td><?php echo $product['stock']; ?></td>
                        <td><?php echo $product['harga']; ?></td>
						<td></td>
						<td></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?delete=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
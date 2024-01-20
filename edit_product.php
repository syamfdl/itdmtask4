<?php
require_once "config.php";
require_once "product.php";

$productHandler = new Product($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $productHandler->getProductById($id);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">EDIT BARANG</h2>
            <a href="index.php" class="btn btn-success pull-left"> Dashboard </a>
        </div>
        <form action="index.php" method="post">
            <input type="hidden" name="update_id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="update_name" class="form-control" value="<?php echo $product['nama_barang']; ?>" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="update_stock" class="form-control" value="<?php echo $product['stock']; ?>" required>
            </div>
            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="update_harga" class="form-control" value="<?php echo $product['harga_beli']; ?>" required>
            </div>
			 <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="update_hargajual" class="form-control" value="<?php echo $product['harga_jual']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#updateForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: $(this).serialize(),
                    success: function (response) {
                        // Update values dynamically on success
                        alert("Product updated successfully!");
                        // You can update specific elements here based on your structure
                        // For example, if you have a div with id="productName" and id="productPrice":
                        // $("#productName").text($("#update_name").val());
                        // $("#productPrice").text($("#update_price").val());
                    },
                    error: function () {
                        alert("Error updating product");
                    }
                });
            });
        });
    </script>
</body>
</html>
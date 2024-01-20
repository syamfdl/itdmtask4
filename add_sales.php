<?php
require_once "config.php";
require_once "product.php";


$productHandler = new Product($conn);

// Retrieve product names from the database
$products = $productHandler->getProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Sales</h2>
		<div class="mt-5 mb-3 clearfix">
            <a href="index.php" class="btn btn-success pull-left"><span class="plus-icon"> BACK </a>
			
        </div>
		
        <form action="index.php" method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <select name="id" class="form-control" required>
                    <option value="" disabled selected>Select Nama Barang</option>
                    <?php
                    // Loop through product names and create options
                    foreach ($products as $product) {
                        echo "<option value=\"{$product['id']}\">{$product['nama_barang']} (ID: {$product['id']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Penjualan</label>
                <input type="number" name="JmlJual" class="form-control" required>
            </div>
            
			<div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tgl" class="form-control" required>
            </div>
            <button type="submit" name="create1" class="btn btn-primary">Submit</button>
			
        </form>
		
    </div>
</body>
</html>

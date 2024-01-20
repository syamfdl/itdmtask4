<?php
require_once "config.php";
require_once "product.php";
require_once "sales.php";

$productHandler = new Product($conn);
$salesHandler = new Sales($conn);

// Create Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $productHandler->setNamabarang($_POST['namabarang']);
    $productHandler->setStock($_POST['stock']);
    $productHandler->setHarga($_POST['harga']);
	$productHandler->setHargaJual($_POST['harga_jual']);
    $productHandler->createProduct();
	 header("Location: tampil_product.php");
// add sales & update stok product
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create1'])) {
    $salesHandler->setId($_POST['id']);
    $salesHandler->setJmlJual($_POST['JmlJual']);
	$salesHandler->setTgl($_POST['tgl']);
    $salesHandler->createSales();

    // Ambil produk berdasarkan ID (asumsi method getProductsById)
    $product = $productHandler->getProductById($_POST['id']);

    if ($product) {
        $stok = $product['stock'];
        $update_name = $product['nama_barang'];
        $update_harga = $product['harga_beli'];
		$update_hargajual = $product['harga_jual'];
        $updateStok = $stok - $_POST['JmlJual'];

        $productHandler->setId($_POST['id']);
        $productHandler->setStock($updateStok);
        $productHandler->setNamaBarang($update_name);
        $productHandler->setHarga($update_harga);
		$productHandler->setHargaJual($update_hargajual);
        $productHandler->updateProduct();
    } else {
        // Penanganan jika produk tidak ditemukan
        echo "Produk dengan ID {$_POST['id']} tidak ditemukan.";
    }
	 header("Location: tampil_sales.php");

}



// Read sales
$salesHandler = new Sales($conn);

// Retrieve product names from the database
$sales = $salesHandler->getSalesJoin();


// Update Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $productHandler->setId($_POST['update_id']);
    $productHandler->setNamaBarang($_POST['update_name']);
    $productHandler->setStock($_POST['update_stock']);
    $productHandler->setHarga($_POST['update_harga']);
	$productHandler->setHargaJual($_POST['update_hargajual']);
    $productHandler->updateProduct();
	 header("Location: tampil_product.php");
}

// Delete Product
if (isset($_GET['delete'])) {
    $productHandler->setId($_GET['delete']);
    $productHandler->deleteProduct();
	header("Location: tampil_product.php");
}elseif(isset($_GET['delete1'])) {
    $salesHandler->setIdJual($_GET['delete1']);
    $salesHandler->deleteSales();
	header("Location: tampil_sales.php");
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
            <h2 class="pull-left">DASHBOARD</h2>
            <a href="tampil_product.php" class="btn btn-success pull-left"> Barang </a>
			<a href="tampil_sales.php" class="btn btn-success pull-left"> Penjualan </a>
        </div>
		

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli/pcs</th>
					 <th>Harga Jual/pcs</th>
                    <th>Terjual (pcs)</th>
					<th>Laba</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale) : ?>
                    <tr>
                        <td><?php echo $sale['id']; ?></td>
                        <td><?php echo $sale['nama_barang']; ?></td>
                        <td><?php echo $sale['stock']; ?></td>
                        <td>Rp. <?php echo $sale['harga_beli']; ?>,-</td>
						<td>Rp. <?php echo $sale['harga_jual']; ?>,-</td>
						<td><?php echo $sale['terjual']; ?></td>
						<td>Rp. <?php echo $sale['laba']; ?>,-</td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
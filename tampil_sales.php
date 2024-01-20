<?php
require_once "config.php";
require_once "sales.php";

$salesHandler = new Sales($conn);

// Retrieve product names from the database
$sales = $salesHandler->getSales();
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
            <h2 class="pull-left">PENJUALAN</h2>
            <a href="index.php" class="btn btn-success pull-left">Dashboard</a>
            <a href="add_sales.php" class="btn btn-success pull-left">Input Penjualan</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Penjualan</th>
					<th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale) : ?>
                    <tr>
                        <td><?php echo $sale['id_penjualan']; ?></td>
                        <td><?php echo $sale['nama_barang']; ?></td>
                        <td><?php echo $sale['jml_jual']; ?></td>
                        
						<td><?php echo $sale['tanggal']; ?></td>
                        <td>
  
                            <a href="index.php?delete1=<?php echo $sale['id_penjualan']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

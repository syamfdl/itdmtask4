<?php

class Product {
    private $conn;
    private $id;
    private $namabarang;
    private $stock;
    private $harga;
	private $hargajual;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Setter methods
    public function setId($id) {
        $this->id = $id;
    }

    public function setNamaBarang($namabarang) {
        $this->namabarang = $namabarang;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setHarga($harga) {
        $this->harga = $harga;
    }
	
	public function setHargaJual($hargajual) {
        $this->hargajual = $hargajual;
    }

    public function getId() {
        return $this->id;
    }

    public function getNamaBarang() {
        return $this->namabarang;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getHarga() {
        return $this->harga;
    }
	
	public function getHargaJual() {
        return $this->hargajual;
    }

    public function createProduct() {
        $sql = "INSERT INTO product (nama_barang, stock, harga_beli, harga_jual) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdd", $this->namabarang, $this->stock, $this->harga, $this->hargajual);
        return $stmt->execute();
    }

    public function getProducts() {
        $products = array();
        $result = $this->conn->query("SELECT * FROM product");
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProduct() {
        $stmt = $this->conn->prepare("UPDATE product SET nama_barang=?, stock=?, harga_beli=?, harga_jual=? WHERE id=?");
        $stmt->bind_param("ssdid", $this->namabarang, $this->stock, $this->harga, $this->hargajual, $this->id);
        return $stmt->execute();
    }

    public function deleteProduct() {
        $stmt = $this->conn->prepare("DELETE FROM product WHERE id=?");
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}



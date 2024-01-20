<?php
class Sales {
    private $conn;
    private $id_penjualan;
    private $jmljual;
    private $total;
    private $id;
	private $tgl;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Setter methods
    public function setIdJual($id_penjualan) {
        $this->id_jual = $id_penjualan;
    }

    public function setJmlJual($jmljual) {
        $this->jmljual = $jmljual;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setId($id) {
        $this->id = $id;
    }
	
	public function setTgl($tgl) {
        $this->tgl = $tgl;
    }

    public function getIdJual() {
        return $this->idjual;
    }

    public function getJmlJual() {
        return $this->jmljual;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getId() {
        return $this->id;
    }

    public function createSales() {
        $sql = "INSERT INTO penjualan (id_penjualan, jml_jual, total, id, tanggal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidis", $this->id_jual, $this->jmljual, $this->total, $this->id, $this->tgl) ;
        return $stmt->execute();
    }

    public function getSales() {
        $sales = array();
        $result = $this->conn->query("SELECT penjualan.id_penjualan, penjualan.tanggal, product.id, product.nama_barang, penjualan.jml_jual, 
									penjualan.total, product.stock, product.harga_beli, SUM(penjualan.jml_jual) as terjual
                                  FROM penjualan
                                  JOIN product ON penjualan.id = product.id
                                  GROUP BY penjualan.id_penjualan");
        while ($row = $result->fetch_assoc()) {
            $sales[] = $row;
        }
        return $sales;
    }
	
	public function getSalesJoin() {
    $sales = array();
    $result = $this->conn->query("SELECT penjualan.id_penjualan, penjualan.tanggal, penjualan.total, product.id, product.nama_barang, penjualan.jml_jual, 
									penjualan.total, product.stock, product.harga_beli, product.harga_jual, 
									SUM(penjualan.jml_jual) as terjual, ((product.harga_jual * SUM(penjualan.jml_jual)) - (product.harga_beli * SUM(penjualan.jml_jual))) as laba
                                  FROM penjualan
                                  JOIN product ON penjualan.id = product.id
                                  GROUP BY penjualan.id");
    while ($row = $result->fetch_assoc()) {
        $sales[] = $row;
    }
    return $sales;
}


    public function getSalesById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM penjualan WHERE id_penjualan = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateSales() {
        $stmt = $this->conn->prepare("UPDATE penjualan SET jml_jual=?, total=?, id=? WHERE id_penjualan=?");
        $stmt->bind_param("iidi", $this->jmljual, $this->total, $this->id, $this->id_Jual);
        return $stmt->execute();
    }

    public function deleteSales() {
        $stmt = $this->conn->prepare("DELETE FROM penjualan WHERE id_penjualan=?");
        $stmt->bind_param("i", $this->id_jual);
        return $stmt->execute();
    }
}
?>

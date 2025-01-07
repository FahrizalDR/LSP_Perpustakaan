<?php
class Peminjaman {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllBuku() {
        $query = "SELECT * FROM buku";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pinjamBuku($data) {
        $stmt = $this->conn->prepare("INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali, status) VALUES (?, ?, ?, ?, 'Dipinjam')");
        $stmt->bind_param("ssss", $data['id_anggota'], $data['id_buku'], $data['tanggal_pinjam'], $data['tanggal_kembali']);
        
        return $stmt->execute();
    }
}
?>
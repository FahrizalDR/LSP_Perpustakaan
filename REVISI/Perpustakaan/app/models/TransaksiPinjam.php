<?php
class TransaksiPinjam {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTransaksi() {
        $query = "SELECT * FROM viewTransPinjam";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function kembalikanBuku($data) {
        $stmt = $this->conn->prepare("UPDATE peminjaman SET status = 'Dikembalikan' WHERE id_peminjaman = ?");
        $stmt->bind_param("s", $data['id_peminjaman']);
        
        return $stmt->execute();
    }

    public function insertPengembalian($data) {
        $stmt = $this->conn->prepare("INSERT INTO pengembalian (id_peminjaman, id_anggota, id_buku, tanggal_kembali, keterlambatan, denda) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['id_peminjaman'], $data['id_anggota'], $data['id_buku'], $data['tanggal_kembali'], $data['keterlambatan'], $data['denda']);
        
        return $stmt->execute();
    }
}
?>
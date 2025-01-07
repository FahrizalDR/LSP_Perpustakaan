<?php
class Buku
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllBuku()
    {
        $query = "SELECT * FROM buku";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addBuku($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO buku (id_buku, judul, pengarang, penerbit, tahun_terbit, kategori, jumlah_halaman, deskripsi_buku) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $data['id_buku'], $data['judul'], $data['pengarang'], $data['penerbit'], $data['tahun_terbit'], $data['kategori'], $data['jumlah_halaman'], $data['deskripsi_buku']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBuku($data)
    {
        $stmt = $this->conn->prepare("UPDATE buku SET judul=?, pengarang=?, penerbit=?, tahun_terbit=?, kategori=?, jumlah_halaman=?, deskripsi_buku=? WHERE id_buku=?");
        $stmt->bind_param("ssssssss", $data['judul'], $data['pengarang'], $data['penerbit'], $data['tahun_terbit'], $data['kategori'], $data['jumlah_halaman'], $data['deskripsi_buku'], $data['id_buku']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBuku($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM buku WHERE id_buku = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
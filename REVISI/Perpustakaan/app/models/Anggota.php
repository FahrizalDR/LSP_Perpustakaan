<?php
class Anggota
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllAnggota()
    {
        $query = "SELECT * FROM anggota";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addAnggota($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO anggota (nama_anggota, jenis_kelamin, alamat_anggota, telepon_anggota) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nama_anggota'], $data['jenis_kelamin'], $data['alamat_anggota'], $data['telepon_anggota']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAnggota($data)
    {
        $stmt = $this->conn->prepare("UPDATE anggota SET nama_anggota=?, jenis_kelamin=?, alamat_anggota=?, telepon_anggota=? WHERE id_anggota=?");
        $stmt->bind_param("sssss", $data['nama_anggota'], $data['jenis_kelamin'], $data['alamat_anggota'], $data['telepon_anggota'], $data['id_anggota']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAnggota($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM anggota WHERE id_anggota = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
?>
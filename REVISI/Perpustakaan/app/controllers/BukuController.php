<?php
require_once '../config/koneksiDb.php';
require_once '../app/models/Buku.php';

class BukuController
{
    private $bukuModel;

    public function __construct($db)
    {
        $this->bukuModel = new Buku($db);
    }

    public function index()
    {
        $bukuList = $this->bukuModel->getAllBuku();
        include '../app/views/daftarBuku.php';
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_buku' => $_POST['id_buku'],
                'judul' => $_POST['judul'],
                'pengarang' => $_POST['pengarang'],
                'penerbit' => $_POST['penerbit'],
                'tahun_terbit' => $_POST['tahun_terbit'],
                'kategori' => $_POST['kategori'],
                'jumlah_halaman' => $_POST['jumlah_halaman'],
                'deskripsi_buku' => $_POST['deskripsi_buku']
            ];
            $this->bukuModel->addBuku($data);
            header("Location: ../public/index.php?status=addsuccess");
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_buku' => $_POST['id_buku'],
                'judul' => $_POST['judul'],
                'pengarang' => $_POST['pengarang'],
                'penerbit' => $_POST['penerbit'],
                'tahun_terbit' => $_POST['tahun_terbit'],
                'kategori' => $_POST['kategori'],
                'jumlah_halaman' => $_POST['jumlah_halaman'],
                'deskripsi_buku' => $_POST['deskripsi_buku']
            ];
            if ($this->bukuModel->updateBuku($data)) {
                header("Location: ../public/index.php?status=success");
            } else {
                // Handle error
                echo "Error updating book.";
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_buku = $_POST['id_buku'];
            if ($this->bukuModel->deleteBuku($id_buku)) {
                header("Location: ../public/index.php?status=deleted");
            } else {
                // Handle error
                echo "Error deleting book.";
            }
        }
    }
}
?>
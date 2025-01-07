<?php
require_once '../config/koneksiDb.php';
require_once '../app/models/Peminjaman.php';

class PeminjamanController {
    private $peminjamanModel;

    public function __construct($db) {
        $this->peminjamanModel = new Peminjaman($db);
    }

    public function index() {
        $bukuList = $this->peminjamanModel->getAllBuku();
        include '../app/views/peminjamanBuku.php';
    }

    public function pinjam() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_anggota' => $_POST['id_anggota'],
                'id_buku' => $_POST['id_buku'],
                'tanggal_pinjam' => $_POST['tanggal_pinjam'],
                'tanggal_kembali' => $_POST['tanggal_kembali']
            ];
            if ($this->peminjamanModel->pinjamBuku($data)) {
                header("Location: index.php?action=peminjamanBuku&status=success");
            } else {
                echo "Error borrowing book.";
            }
        }
    }
}
?>
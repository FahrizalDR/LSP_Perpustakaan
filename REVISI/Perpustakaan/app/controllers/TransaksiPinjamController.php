<?php
require_once '../config/koneksiDb.php';
require_once '../app/models/TransaksiPinjam.php';

class TransaksiPinjamController {
    private $transaksiModel;

    public function __construct($db) {
        $this->transaksiModel = new TransaksiPinjam($db);
    }

    public function index() {
        $transaksiList = $this->transaksiModel->getAllTransaksi();
        include '../app/views/transaksiPinjam.php';
    }

    public function kembalikan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_peminjaman' => $_POST['id_peminjaman'],
                'id_anggota' => $_POST['id_anggota'],
                'id_buku' => $_POST['id_buku'],
                'tanggal_kembali' => $_POST['tanggal_pengembalian'],
                'keterlambatan' => $_POST['keterlambatan'],
                'denda' => $_POST['denda']
            ];
    
            // Update status peminjaman
            $this->transaksiModel->kembalikanBuku($data);
    
            // Insert data pengembalian
            if ($this->transaksiModel->insertPengembalian($data)) {
                header("Location: index.php?action=riwayatTransaksiPinjam&status=success");
            } else {
                echo "Error inserting return data.";
            }
        }
    }
}
?>
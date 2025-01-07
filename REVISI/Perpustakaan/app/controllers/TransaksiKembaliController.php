<?php
require_once '../config/koneksiDb.php';
require_once '../app/models/TransaksiKembali.php';

class TransaksiKembaliController {
    private $transaksiKembaliModel;

    public function __construct($db) {
        $this->transaksiKembaliModel = new TransaksiKembali($db);
    }

    public function index() {
        $transKembaliList = $this->transaksiKembaliModel->getAllTransKembali();
        include '../app/views/transaksiKembali.php';
    }    
}
?>
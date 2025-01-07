<?php
require_once '../config/koneksiDb.php';
require_once '../app/models/Anggota.php';

class AnggotaController
{
    private $anggotaModel;

    public function __construct($db)
    {
        $this->anggotaModel = new Anggota($db);
    }

    public function index()
    {
        $anggotaList = $this->anggotaModel->getAllAnggota();
        include '../app/views/daftarAnggota.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [                
                'nama_anggota' => $_POST['nama_anggota'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'alamat_anggota' => $_POST['alamat_anggota'],
                'telepon_anggota' => $_POST['telepon_anggota']
            ];
            if ($this->anggotaModel->addAnggota($data)) {
                header("Location: index.php?action=daftarAnggota&status=addsuccess");
            } else {
                echo "Error adding member.";
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_anggota' => $_POST['id_anggota'],
                'nama_anggota' => $_POST['nama_anggota'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'alamat_anggota' => $_POST['alamat_anggota'],
                'telepon_anggota' => $_POST['telepon_anggota']
            ];
            if ($this->anggotaModel->updateAnggota($data)) {
                header("Location: index.php?action=daftarAnggota&status=success");
            } else {
                echo "Error updating member.";
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_anggota = $_POST['id_anggota'];
            if ($this->anggotaModel->deleteAnggota($id_anggota)) {
                header("Location: index.php?action=daftarAnggota&status=deleted");
            } else {
                // Handle error
                echo "Error deleting member.";
            }
        }
    }
}
?>
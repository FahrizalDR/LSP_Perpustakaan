<?php
require_once '../config/koneksiDb.php';
require_once '../app/controllers/BukuController.php';
require_once '../app/controllers/AnggotaController.php';
require_once '../app/controllers/PeminjamanController.php';
require_once '../app/controllers/TransaksiPinjamController.php';
require_once '../app/controllers/TransaksiKembaliController.php';


$db = new mysqli($servername, $user, $pass, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Buat instance dari semua controller
$bukuController = new BukuController($db);
$anggotaController = new AnggotaController($db);
$peminjamanController = new PeminjamanController($db);
$transaksiPinjamController = new TransaksiPinjamController($db);
$transaksiKembaliController = new TransaksiKembaliController($db);


// Tentukan action berdasarkan parameter GET
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Mapping action ke controller dan metode
$routes = [
    'daftarBuku' => [$bukuController, 'index'],
    'addBuku' => [$bukuController, 'add'],
    'updateBuku' => [$bukuController, 'update'],
    'deleteBuku' => [$bukuController, 'delete'],
    'daftarAnggota' => [$anggotaController, 'index'],
    'addAnggota' => [$anggotaController, 'add'],
    'updateAnggota' => [$anggotaController, 'update'],
    'deleteAnggota' => [$anggotaController, 'delete'],
    'peminjamanBuku' => [$peminjamanController, 'index'],
    'prosesPinjam' => [$peminjamanController, 'pinjam'],
    'riwayatTransaksiPinjam' => [$transaksiPinjamController, 'index'],
    'prosesKembali' => [$transaksiPinjamController, 'kembalikan'],
    'riwayatTransaksiKembali' => [$transaksiKembaliController, 'index'],
];

// Cek apakah action ada dalam routes
if (array_key_exists($action, $routes)) {
    call_user_func($routes[$action]); // Panggil metode yang sesuai
} else {
    $bukuController->index(); // Default action
}

// $bukuController = new BukuController($db);
// $action = isset($_GET['action']) ? $_GET['action'] : 'index';
// if (method_exists($bukuController, $action)) {
//     $bukuController->$action();
// } else {
//     $bukuController->index();
// }


?>
<?php
include '../../koneksiDb.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $keterlambatan = $_POST['keterlambatan']; // Dalam format 'x hari'
    $denda = $_POST['denda'];

    // Bersihkan data keterlambatan untuk hanya menyimpan angka hari
    // $keterlambatan_hari = (int) filter_var($keterlambatan, FILTER_SANITIZE_NUMBER_INT);

    // Query untuk menyisipkan data ke tabel pengembalian
    $queryInsertPengembalian = "
        INSERT INTO pengembalian (id_peminjaman, id_anggota, id_buku, tanggal_kembali, keterlambatan, denda)
        VALUES ('$id_peminjaman', '$id_anggota', '$id_buku', '$tanggal_pengembalian', '$keterlambatan', '$denda')
    ";

    // Query untuk memperbarui status di tabel peminjaman
    $queryUpdatePeminjaman = "
        UPDATE peminjaman
        SET status = 'Dikembalikan'
        WHERE id_peminjaman = '$id_peminjaman'
    ";

    // Eksekusi query
    $insertPengembalian = mysqli_query($conn, $queryInsertPengembalian);
    $updatePeminjaman = mysqli_query($conn, $queryUpdatePeminjaman);

    // Cek apakah kedua query berhasil
    if ($insertPengembalian && $updatePeminjaman) {
        echo "<script>            
            window.location.href = 'peminjaman.php?status=success';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat memproses pengembalian. Silakan coba lagi.');
            window.location.href = 'peminjaman.php?status=gagal';
        </script>";
    }
}
?>
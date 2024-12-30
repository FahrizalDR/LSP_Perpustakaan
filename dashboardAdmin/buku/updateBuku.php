<?php
include '../../koneksiDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE buku 
            SET id_buku = '$_POST[id_buku]',
            judul = '$_POST[judul]', 
            pengarang = '$_POST[pengarang]', 
            penerbit = '$_POST[penerbit]', 
            tahun_terbit = '$_POST[tahun_terbit]',
            kategori = '$_POST[kategori]',
            jumlah_halaman = '$_POST[jumlah_halaman]',
            deskripsi_buku = '$_POST[deskripsi_buku]'            
            WHERE id_buku = '$_POST[id_buku]'";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil diupdate!";
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer?status=success");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    } else {
    echo "Invalid request method.";
    }
?>
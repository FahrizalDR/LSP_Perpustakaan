<?php
include '../../koneksiDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "INSERT INTO buku 
            VALUES ('$_POST[id_buku]', 
            '$_POST[judul]', 
            '$_POST[pengarang]', 
            '$_POST[penerbit]', 
            '$_POST[tahun_terbit]', 
            '$_POST[kategori]', 
            '$_POST[jumlah_halaman]', 
            '$_POST[deskripsi_buku]')";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil diupdate!";
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer?status=addsuccess");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    } else {
    echo "Invalid request method.";
    }
?>
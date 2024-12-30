<?php
include '../../koneksiDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali, status) 
            VALUES ('$_POST[id_anggota]', 
            '$_POST[id_buku]', 
            '$_POST[tanggal_pinjam]', 
            '$_POST[tanggal_kembali]', 
            'Dipinjam')";

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
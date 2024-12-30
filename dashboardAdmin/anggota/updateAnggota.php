<?php
include '../../koneksiDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE anggota 
            SET id_anggota = '$_POST[id_anggota]',
            nama_anggota = '$_POST[nama_anggota]', 
            jenis_kelamin = '$_POST[jenis_kelamin]', 
            alamat_anggota = '$_POST[alamat_anggota]', 
            telepon_anggota = '$_POST[telepon_anggota]'           
            WHERE id_anggota = '$_POST[id_anggota]'";

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
<?php
include '../../koneksiDb.php';


if (isset($_POST['id_anggota'])) {
    $id_anggota = $_POST['id_anggota'];

    $query = "DELETE FROM anggota WHERE id_anggota='$id_anggota'";
    if (mysqli_query($conn, $query)) {
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer?status=deleted");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
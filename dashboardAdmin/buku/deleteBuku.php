<?php
include '../../koneksiDb.php';


if (isset($_POST['id_buku'])) {
    $id_buku = $_POST['id_buku'];

    $query = "DELETE FROM buku WHERE id_buku='$id_buku'";
    if (mysqli_query($conn, $query)) {
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer?status=deleted");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
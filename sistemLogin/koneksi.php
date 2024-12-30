<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "lsp_perpustakaan";
$connect = mysqli_connect($host, $username, $password, $database);

// Fungsi untuk sign up member
function signUp($data)
{
    global $connect;

    // Untuk mengambil data dari form sign up
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $noTlp = htmlspecialchars($data["no_tlp"]);

    // Untuk cek nama sudah ada / belum
    $nameResult = mysqli_query($connect, "SELECT nama_anggota FROM anggota WHERE nama_anggota = '$nama'");
    if (mysqli_fetch_assoc($nameResult)) {
        echo "<script>
    alert('Nama sudah terdaftar');
    </script>";
        return 0;
    }
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Untuk insert ke database
    $querySignUp = "INSERT INTO anggota (nama_anggota, jenis_kelamin, alamat_anggota, telepon_anggota, password_anggota) VALUES('$nama', '$jenis_kelamin', '$alamat', '$noTlp', '$password')";
    mysqli_query($connect, $querySignUp);
    return mysqli_affected_rows($connect);

}

?>
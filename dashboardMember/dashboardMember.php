<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/member/signIn.php");
    exit;
}

$idAnggota = $_SESSION["anggota"]["id_anggota"];
$namaAnggota = $_SESSION["anggota"]["nama_anggota"];

// buat debug liat isi session yang lagi jalan
// echo '<pre>';
// print_r($_SESSION["anggota"]);
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Member</title>
    <link href="../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <?php include '../dashboardMember/headerMember.php' ?>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="../dashboardMember/dashboardMember.php"
                        class="list-group-item list-group-item-action active custom-active">Dashboard</a>
                    <a href="buku/daftarBuku.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="peminjaman/peminjaman.php" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="peminjaman/pengembalian.php" class="list-group-item list-group-item-action">Pengembalian</a>                    
                    <a href="signOut.php" class="list-group-item list-group-item-action bg-danger text-white">Log Out</a>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="card-container">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">Buku</h3>
                            <h6>
                                <table>
                                    <tbody>
                                        <?php include '../koneksiDb.php';

                                        $sql = "select count(id_buku) as jumlah from buku";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["jumlah"] . "</td>  
                                                <td> buku </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </h6>
                            <a href="buku/daftarBuku.php" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">Peminjaman</h3>
                            <h6>
                                <table>
                                    <tbody>
                                        <?php include '../koneksiDb.php';

                                        $sql = "select count(id_peminjaman) as Jumlah from peminjaman as p left join anggota as a on a.id_anggota = p.id_anggota where a.nama_anggota = '$namaAnggota'";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["Jumlah"] . "</td>
                                                <td>transaksi </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </h6>
                            <a href="peminjaman/peminjaman.php" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">Pengembalian</h3>
                            <h6>
                                <table>
                                    <tbody>
                                        <?php include '../koneksiDb.php';

                                        $sql = "select count(id_pengembalian) as Jumlah from pengembalian as p left join anggota as a on a.id_anggota = p.id_anggota where a.nama_anggota = '$namaAnggota'";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["Jumlah"] . "</td>
                                                <td>transaksi </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </h6>
                            <a href="peminjaman/pengembalian.php" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'loginsuccess'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Anda berhasil login!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=loginsuccess') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
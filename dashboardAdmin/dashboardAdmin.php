<?php
session_start();

//Kalau belum sign in, diarahkan ke halaman sign in
if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/admin/signIn.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Admin</title>
    <link href="../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include '../dashboardAdmin/headerAdmin.php' ?>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="../dashboardAdmin/dashboardAdmin.php"
                        class="list-group-item list-group-item-action active custom-active">Dashboard</a>
                    <a href="buku/daftarBuku.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="anggota/daftarAnggota.php" class="list-group-item list-group-item-action">Daftar Anggota</a>
                    <a href="peminjaman/peminjaman.php" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="pengembalian/pengembalian.php" class="list-group-item list-group-item-action">Pengembalian</a>                    
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
                            <h3 class="card-title">Anggota</h3>
                            <h6>
                                <table>
                                    <tbody>
                                        <?php include '../koneksiDb.php';

                                        $sql = "select count(id_anggota) as jumlah from anggota";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["jumlah"] . "</td>
                                                <td>orang </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </h6>
                            <a href="anggota/daftarAnggota.php" class="btn btn-dark">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">Peminjaman</h3>
                            <h6>
                                <table>
                                    <tbody>
                                        <?php include '../koneksiDb.php';

                                        $sql = "select count(id_peminjaman) as jumlah from peminjaman";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["jumlah"] . "</td>
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

                                        $sql = "select count(id_pengembalian) as jumlah from pengembalian";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        }

                                        while ($row = $result->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                <td>Jumlah: </td>
                                                <td>" . $row["jumlah"] . "</td>
                                                <td>transaksi </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </h6>
                            <a href="pengembalian/pengembalian.php" class="btn btn-dark">Lihat Detail</a>
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
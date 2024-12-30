<?php
session_start();

//Kalau belum sign in, diarahkan ke halaman sign in
if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/admin/signIn.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <?php include '../../dashboardMember/headerMember.php' ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="../../dashboardAdmin/dashboardAdmin.php"
                        class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="../buku/daftarBuku.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="../anggota/daftarAnggota.php" class="list-group-item list-group-item-action">Daftar Anggota</a>
                    <a href="../peminjaman/peminjaman.php" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="pengembalian.php" class="list-group-item list-group-item-action active custom-active">Pengembalian</a>                    
                    <a href="../signOut.php" class="list-group-item list-group-item-action bg-danger text-white">Log Out</a>
                </div>
            </div>
            <div class="col-sm-10">
                <diV class="row">
                    <h2 class="title text-center mb-3"><b>Riwayat Transaksi Pengembalian</b></h2>
                </diV>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <form method="POST" action="pengembalian.php" class="search_box float-right">
                            <input type="text" placeholder="Cari Judul / Nama Peminjam" name="cari" value="<?php if (isset($_POST['cari'])) {
                                echo $_POST['cari'];
                            } ?>" style="width: 200px; height: 37px">
                        </form>                         
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Kembali</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Tanggal Pengembalian</th>
                            <th scope="col">Keterlambatan</th>
                            <th scope="col">Denda</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../../koneksiDb.php';

                        if (isset($_POST['cari'])) {
                            $pencarian = $_POST['cari'];
                            $query = "select * from viewTransKembali where `judul` like '%" . $pencarian . "%' or `nama_anggota` like '%" . $pencarian . "%' ";
                        } else {
                            $query = "select * from viewTransKembali;";
                        }
                        
                        $nomor = 1;
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                                    <tr>
                                    <td>$nomor</td>
                                    <td>$row[id_pengembalian]</td>
                                    <td>$row[judul]</td>
                                    <td>$row[nama_anggota]</td>                                    
                                    <td>$row[tanggal_kembali]</td>                                                                                                                                                                           
                                    <td>$row[keterlambatan]</td>                                                                                                                                                                           
                                    <td>$row[denda]</td>                                                                                                                                                                           
                                    <td>";
                            $nomor++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
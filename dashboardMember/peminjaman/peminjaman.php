<?php
session_start();

//Kalau belum sign in, diarahkan ke halaman sign in
if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/signIn.php");
    exit;
}

$idAnggota = $_SESSION["anggota"]["id_anggota"];
$namaAnggota = $_SESSION["anggota"]["nama_anggota"];

// buat debug liat data anggota di session yang lagi jalan
// echo '<pre>';
// print_r($_SESSION["anggota"]);
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <?php include '../../dashboardMember/headerMember.php' ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="../../dashboardMember/dashboardMember.php"
                        class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="../buku/daftarBuku.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="peminjaman.php" class="list-group-item list-group-item-action active custom-active">Peminjaman</a>
                    <a href="pengembalian.php" class="list-group-item list-group-item-action">Pengembalian</a>                    
                    <a href="../signOut.php" class="list-group-item list-group-item-action bg-danger text-white">Log Out</a>
                </div>
            </div>
            <div class="col-sm-10">
                <diV class="row">
                    <h2 class="title text-center mb-3"><b>Riwayat Transaksi Peminjaman</b></h2>
                </diV>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <form method="POST" action="peminjaman.php" class="search_box float-right">
                            <input type="text" placeholder="Cari Judul Buku" name="cari" value="<?php if (isset($_POST['cari'])) {
                                echo $_POST['cari'];
                            } ?>" style="width: 200px; height: 37px">
                        </form>
                        <!-- <input type="text" id="searchInput" class="form-control" placeholder="Cari Data Buku"
                            onkeyup="filterData()"> -->
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Pinjam</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tenggat Pengembalian</th>
                            <th scope="col">Status</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../../koneksiDb.php';

                        if (isset($_POST['cari'])) {
                            $pencarian = $_POST['cari'];
                            $query = "select * from viewTransPinjam where `judul` like '%" . $pencarian . "%' and nama_anggota = '$namaAnggota' ";
                        } else {
                            $query = "select * from viewTransPinjam where nama_anggota = '$namaAnggota';";
                        }

                        // $query = "select * from buku";
                        $nomor = 1;
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                                    <tr>
                                    <td>$nomor</td>
                                    <td>$row[id_peminjaman]</td>
                                    <td>$row[judul]</td>
                                    <td>$row[nama_anggota]</td>
                                    <td>$row[tanggal_pinjam]</td>
                                    <td>$row[tanggal_kembali]</td>                                                                                                                                                                           
                                    <td>$row[status]</td>                                                                                                                                                                           
                                    <td>";
                            if ($row['status'] == 'Dipinjam') {
                                echo " <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#kembalikanBuku$nomor'>Kembalikan</button>";
                            } else {
                                // Anda bisa menambahkan tombol lain di sini jika diperlukan
                                echo " - ";
                            }
                            echo " </td>                                                                                                                                                                            
                                    </tr>
                                    <div class='modal fade' id='kembalikanBuku$nomor' tabindex='-1' aria-labelledby='kembalikanBukuLabel$nomor' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <form method='POST' action='kembaliinBuku.php'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='kembalikanBukuLabel$nomor'>Pengembalian Buku</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='id_peminjaman' value='$row[id_peminjaman]'>
                                                        <input type='hidden' name='id_anggota' value='$row[id_anggota]'> 
                                                        <input type='hidden' name='id_buku' value='$row[id_buku]'>
                                                        <div class='mb-3'>
                                                            <label for='tanggal-pinjam-$nomor' class='form-label'>Tanggal Pinjam</label>
                                                            <input type='date' class='form-control' id='tanggal-pinjam-kembali-$nomor' name='tenggat_kembali' value='$row[tanggal_pinjam]' readonly>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='tenggat-pengembalian-$nomor' class='form-label'>Tenggat Pengembalian</label>
                                                            <input type='date' class='form-control' id='tenggat-kembali-$nomor' name='tenggat_kembali' value='$row[tanggal_kembali]' readonly>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='tanggal-pengembalian-$nomor' class='form-label'>Tanggal pengembalian</label>
                                                            <input type='date' class='form-control' id='tanggal-pengembalian-$nomor' name='tanggal_pengembalian' required onchange='hitungKeterlambatan$nomor()'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='keterlambatan-$nomor' class='form-label'>Keterlambatan</label>
                                                            <input type='text' class='form-control' id='keterlambatan-$nomor' name='keterlambatan' readonly>                                                            
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='denda-$nomor' class='form-label'>Denda</label>
                                                            <input type='number' class='form-control' id='denda-$nomor' name='denda' readonly>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <button type='submit' class='btn btn-primary'>Konfirmasi Pengembalian</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function hitungKeterlambatan$nomor() {
                                            const tenggat = new Date(document.getElementById('tenggat-kembali-$nomor').value);
                                            const tanggalPengembalian = new Date(document.getElementById('tanggal-pengembalian-$nomor').value);
                                            const dendaPerHari = 10000; // Denda per hari dalam rupiah
                                            
                                            if (tanggalPengembalian > tenggat) {
                                                const selisihHari = Math.ceil((tanggalPengembalian - tenggat) / (1000 * 60 * 60 * 24));
                                                document.getElementById('keterlambatan-$nomor').value = selisihHari + ' hari';
                                                document.getElementById('denda-$nomor').value = selisihHari * dendaPerHari;
                                            } else {
                                                document.getElementById('keterlambatan-$nomor').value = '0 hari';
                                                document.getElementById('denda-$nomor').value = 0;
                                            }
                                        }
                                    </script>                                    
                                    ";
                            $nomor++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Buku berhasil dikembalikan!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=success') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
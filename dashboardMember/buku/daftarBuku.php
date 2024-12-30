<?php
session_start();

//Kalau belum sign in, diarahkan ke halaman sign in
if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/signIn.php");
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
                    <a href="daftarBuku.php" class="list-group-item list-group-item-action active custom-active">Daftar
                        Buku</a>
                    <a href="../peminjaman/peminjaman.php" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="../peminjaman/pengembalian.php" class="list-group-item list-group-item-action">Pengembalian</a>                    
                    <a href="../signOut.php" class="list-group-item list-group-item-action bg-danger text-white">Log Out</a>
                </div>
            </div>
            <div class="col-sm-10">
                <diV class="row">
                    <h2 class="title text-center mb-3"><b>Daftar Buku</b></h2>
                </diV>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <form method="POST" action="daftarBuku.php" class="search_box float-right">
                            <input type="text" placeholder="Cari Judul / Pengarang" name="cari" value="<?php if (isset($POST['cari'])) {
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
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Deskripsi</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../../koneksiDb.php';

                        if (isset($_POST['cari'])) {
                            $pencarian = $_POST['cari'];
                            $query = "select * from buku where `judul` like '%" . $pencarian . "%'
                                or `pengarang` like '%" . $pencarian . "%' ";
                        } else {
                            $query = "select * from buku;";
                        }

                        // $query = "select * from buku";
                        $nomor = 1;
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                                    <tr>
                                    <td>$nomor</td>                                    
                                    <td>$row[judul]</td>
                                    <td>$row[pengarang]</td>                                                                                                                                                                           
                                    <td>$row[deskripsi_buku]</td>                                                                                                                                                                           
                                    <td> <button type='button' class='btn btn-warning mb-2' data-bs-toggle='modal' data-bs-target='#editBuku$nomor'>
                                        <i class='fa-solid fa-eye'></i>
                                        </button>
                                        <br>                                                                                                                                                                           
                                        <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#pinjamBuku$nomor'>
                                        <i class='fa-solid fa-hand-holding'></i>
                                        </button>
                                    </td>                                                                                                                                                                            
                                    </tr>
                                    <div class='modal fade' id='editBuku$nomor' tabindex='-1' aria-labelledby='editBukuLabel$nomor' aria-hidden='true' data-bs-backdrop='static' data-bs-keyboard='false'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <form method='POST' action='updateBuku.php'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='editBukuLabel$nomor'>Detail Buku</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        
                                                        <div class='mb-3'>
                                                            <label for='id-buku-$nomor' class='form-label'>ID Buku</label>
                                                            <input type='text' readonly class='form-control' id='id-buku-$nomor' name='id_buku' value='$row[id_buku]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='judul-$nomor' class='form-label'>Judul</label>
                                                            <input type='text' readonly class='form-control' id='judul-$nomor' name='judul' value='$row[judul]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='pengarang-$nomor' class='form-label'>Pengarang</label>
                                                            <input type='text' readonly class='form-control' id='pengarang-$nomor' name='pengarang' value='$row[pengarang]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='penerbit-$nomor' class='form-label'>Penerbit</label>
                                                            <input type='text' readonly class='form-control' id='penerbit-$nomor' name='penerbit' value='$row[penerbit]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='tahun-terbit-$nomor' class='form-label'>Tahun Terbit</label>
                                                            <input type='text' readonly class='form-control' id='tahun-terbit-$nomor' name='tahun_terbit' value='$row[tahun_terbit]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='kategori-$nomor' class='form-label'>Kategori</label>
                                                            <input type='text' readonly class='form-control' id='kategori-$nomor' name='kategori' value='$row[kategori]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='jumlah-halaman-$nomor' class='form-label'>Halaman</label>
                                                            <input type='text' readonly class='form-control' id='jumlah-halaman-$nomor' name='jumlah_halaman' value='$row[jumlah_halaman]'>
                                                        </div>                                                        
                                                        <div class='mb-3'>
                                                            <label for='deskripsi-buku-$nomor' class='form-label'>Deskripsi</label>
                                                            <textarea readonly class='form-control' id='deskripsi-buku-$nomor' name='deskripsi_buku' rows='3'>$row[deskripsi_buku]</textarea>
                                                        </div>

                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                        <button type='button' class='btn btn-primary' name='simpan' data-bs-toggle='modal' data-bs-target='#pinjamBuku$nomor'>Pinjam</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>                                    
                                        <!-- Modal Pinjam -->
                                        <div class='modal fade' id='pinjamBuku$nomor' tabindex='-1' aria-labelledby='pinjamBukuLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='pinjamBukuLabel'>Pinjam Buku</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form method='post' action='pinjamBuku.php'>
                                                            <input type='hidden' name='id_anggota' value='$idAnggota'>
                                                            <input type='hidden' id='id-buku-$nomor' name='id_buku' value='$row[id_buku]'>                                                
                                                            <div class='mb-3'>
                                                                <label for='judul-$nomor' class='form-label'>Judul</label>
                                                                <input type='text' readonly class='form-control' id='judul-$nomor' name='judul' value='$row[judul]'>
                                                            </div>  <div class='mb-3'>
                                                                <label for='nama-$nomor' class='form-label'>Nama Peminjam</label>
                                                                <input type='text' readonly class='form-control' id='nama-$nomor' name='nama_peminjam' value='$namaAnggota'>
                                                            </div>                                                                                                               
                                                            <div class='mb-3'>
                                                                <label for='tanggal-pinjam-$nomor' class='form-label'>Tanggal Pinjam</label>
                                                                <input type='date' class='form-control' id='tanggal-pinjam-$nomor' name='tanggal_pinjam' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='tanggal-kembali-$nomor' class='form-label'>Tenggat Pengembalian</label>
                                                                <input type='date' class='form-control' id='tanggal-kembali-$nomor' name='tanggal_kembali' readonly>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                                <button type='submit' class='btn btn-primary'>Konfirmasi Pinjam</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        document.querySelectorAll('[id^="tanggal-pinjam"]').forEach(function (element) {
            element.addEventListener('change', function () {
                const nomor = this.id.split('-')[2]; // Ambil nomor dari ID
                const tanggalPinjam = new Date(this.value);
                if (isNaN(tanggalPinjam)) return; // Jika tanggal tidak valid, keluar
                const tanggalKembali = new Date(tanggalPinjam);
                tanggalKembali.setDate(tanggalPinjam.getDate() + 7); // Menambahkan 7 hari
                const inputTanggalKembali = document.getElementById('tanggal-kembali-' + nomor);
                inputTanggalKembali.value = tanggalKembali.toISOString().split('T')[0]; // Format ke YYYY-MM-DD
            });
        });
    </script>

    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Anda berhasil meminjam buku!',
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
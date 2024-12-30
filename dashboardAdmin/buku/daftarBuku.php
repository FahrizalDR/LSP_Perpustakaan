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
    <title>Daftar Buku</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include '../../dashboardAdmin/headerAdmin.php' ?>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="../../dashboardAdmin/dashboardAdmin.php" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="daftarBuku.php" class="list-group-item list-group-item-action active custom-active">Daftar Buku</a>
                    <a href="../anggota/daftarAnggota.php" class="list-group-item list-group-item-action">Daftar Anggota</a>
                    <a href="../peminjaman/peminjaman.php" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="../pengembalian/pengembalian.php" class="list-group-item list-group-item-action">Pengembalian</a>                    
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
                            <input type="text" placeholder="Cari Judul / Pengarang" name="cari" value="<?php if (isset($_POST['cari'])) {
                                echo $_POST['cari'];
                            } ?>" style="width: 200px; height: 37px">
                        </form>                        
                    </div>
                    <div class="col-sm-2">
                        <button type='button' class='btn btn-success' data-bs-toggle='modal'
                            data-bs-target='#tambahBuku'>Tambah Buku
                        </button>
                        <div class='modal fade' id='tambahBuku' tabindex='-1' aria-labelledby='tambahBukuLabel'
                            aria-hidden='true' data-bs-backdrop='static' data-bs-keyboard='false'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                    <form method='POST' action='tambahBuku.php'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='tambahBukuLabel'>Form Tambah Buku</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal'
                                                aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <div class="mb-3">
                                                <label for="id_buku" class="form-label">ID Buku</label>
                                                <input type="text" class="form-control" id="id_buku" name="id_buku"
                                                    placeholder="Masukkan ID buku" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul Buku</label>
                                                <input type="text" class="form-control" id="judul" name="judul"
                                                    placeholder="Masukkan judul buku" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pengarang" class="form-label">Pengarang</label>
                                                <input type="text" class="form-control" id="pengarang" name="pengarang"
                                                    placeholder="Masukkan nama pengarang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="penerbit" class="form-label">Penerbit</label>
                                                <input type="text" class="form-control" id="penerbit" name="penerbit"
                                                    placeholder="Masukkan nama penerbit" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                                <input type="text" class="form-control" id="tahun_terbit"
                                                    name="tahun_terbit" placeholder="Masukkan tahun terbit" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori"
                                                    placeholder="Masukkan kategori" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                                                <input type="number" class="form-control" id="jumlah_halaman"
                                                    name="jumlah_halaman" placeholder="Masukkan jumlah halaman"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi_buku" class="form-label">Deskripsi Buku</label>
                                                <textarea class="form-control" id="deskripsi_buku" name="deskripsi_buku"
                                                    rows="4" placeholder="Masukkan deskripsi buku" required></textarea>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary'
                                                data-bs-dismiss='modal'>Batal</button>
                                            <button type='submit' class='btn btn-primary' name='tambah'>Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Buku</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Halaman</th>
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
                                    <td>$row[id_buku]</td>
                                    <td>$row[judul]</td>
                                    <td>$row[pengarang]</td>
                                    <td>$row[penerbit]</td>                                                                                                                                       
                                    <td>$row[tahun_terbit]</td>
                                    <td>$row[kategori]</td>
                                    <td>$row[jumlah_halaman]</td>                            
                                    <td> <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editBuku$nomor'>
                                        <i class='fas fa-edit'></i>
                                        </button>                                                                                                                                                                           
                                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapusBuku$nomor'>
                                        <i class='fas fa-trash'></i>
                                        </button>
                                    </td>                                                                                                                                                                            
                                    </tr>
                                    <div class='modal fade' id='editBuku$nomor' tabindex='-1' aria-labelledby='editBukuLabel$nomor' aria-hidden='true' data-bs-backdrop='static' data-bs-keyboard='false'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <form method='POST' action='updateBuku.php'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='editBukuLabel$nomor'>Edit Data Buku</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        
                                                        <div class='mb-3'>
                                                            <label for='id-buku-$nomor' class='form-label'>ID Buku</label>
                                                            <input type='text' readonly class='form-control' id='id-buku-$nomor' name='id_buku' value='$row[id_buku]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='judul-$nomor' class='form-label'>Judul</label>
                                                            <input type='text' class='form-control' id='judul-$nomor' name='judul' value='$row[judul]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='pengarang-$nomor' class='form-label'>Pengarang</label>
                                                            <input type='text' class='form-control' id='pengarang-$nomor' name='pengarang' value='$row[pengarang]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='penerbit-$nomor' class='form-label'>Penerbit</label>
                                                            <input type='text' class='form-control' id='penerbit-$nomor' name='penerbit' value='$row[penerbit]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='tahun-terbit-$nomor' class='form-label'>Tahun Terbit</label>
                                                            <input type='text' class='form-control' id='tahun-terbit-$nomor' name='tahun_terbit' value='$row[tahun_terbit]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='kategori-$nomor' class='form-label'>Kategori</label>
                                                            <input type='text' class='form-control' id='kategori-$nomor' name='kategori' value='$row[kategori]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='jumlah-halaman-$nomor' class='form-label'>Halaman</label>
                                                            <input type='text' class='form-control' id='jumlah-halaman-$nomor' name='jumlah_halaman' value='$row[jumlah_halaman]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='deskripsi-buku-$nomor' class='form-label'>Deskripsi</label>
                                                            <textarea class='form-control' id='deskripsi-buku-$nomor' name='deskripsi_buku' row=3>$row[deskripsi_buku]</textarea>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <button type='submit' class='btn btn-primary' name='simpan'>Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>                                    
                                        <div class='modal fade' id='hapusBuku$nomor' tabindex='-1' aria-labelledby='hapusBukuLabel$nomor' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5' id='hapusBukuLabel$nomor'>Konfirmasi</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Anda yakin akan menghapus buku ini?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <form method='POST' action='deleteBuku.php'>
                                                            <input type='hidden' name='id_buku' value='$row[id_buku]'>
                                                            <button type='submit' class='btn btn-primary'>Hapus</button>
                                                        </form
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
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'addsuccess'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil ditambahkan!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=addsuccess') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>    
    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil diedit!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=success') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>
    <script>
        // Menampilkan SweetAlert jika status penghapusan sukses
        <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dihapus!',
                showConfirmButton: false,
                timer: 2000
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=deleted') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
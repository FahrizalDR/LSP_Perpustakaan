<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index .php" style="color:white ; margin-left:5px">Admin Perpustakaan</a>
        </div>
    </nav>
</header>

<body>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">
                    <a href="index.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="index.php?action=daftarAnggota" class="list-group-item list-group-item-action active" style="color: white; background-color:rgb(0, 0, 0);">Daftar Anggota</a>
                    <a href="index.php?action=peminjamanBuku" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="index.php?action=riwayatTransaksiPinjam" class="list-group-item list-group-item-action">Transaksi Pinjam</a>
                    <a href="index.php?action=riwayatTransaksiKembali" class="list-group-item list-group-item-action">Transaksi Kembali</a>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <h2 class="title text-center mb-3"><b>Daftar Anggota</b></h2>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <button type='button' class='btn btn-success' data-bs-toggle='modal'
                            data-bs-target='#tambahAnggota'>Tambah Anggota</button>
                    </div>
                    <div class='modal fade' id='tambahAnggota' tabindex='-1' aria-labelledby='tambahAnggotaLabel'
                        aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <form method='POST' action='index.php?action=addAnggota'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='tambahAnggotaLabel'>Form Tambah Anggota</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal'
                                            aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>                                        
                                        <div class='mb-3'>
                                            <label for='nama_anggota' class='form-label'>Nama</label>
                                            <input type='text' class='form-control' id='nama_anggota'
                                                name='nama_anggota' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='jenis_kelamin' class='form-label'>Jenis Kelamin</label>
                                            <select class='form-select' id='jenis_kelamin' name='jenis_kelamin'
                                                required>
                                                <option value=''>Pilih Jenis Kelamin</option>
                                                <option value='Laki laki'>Laki-laki</option>
                                                <option value='Perempuan'>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='alamat_anggota' class='form-label'>Alamat</label>
                                            <input type='text' class='form-control' id='alamat_anggota'
                                                name='alamat_anggota' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='telepon_anggota' class='form-label'>Telepon</label>
                                            <input type='text' class='form-control' id='telepon_anggota'
                                                name='telepon_anggota' required>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary'
                                            data-bs-dismiss='modal'>Tutup</button>
                                        <button type='submit' class='btn btn-primary'>Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Anggota</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No.Telepon</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($anggotaList as $row) {
                            echo "
                                    <tr>
                                    <td>$nomor</td>
                                    <td>$row[id_anggota]</td>
                                    <td>$row[nama_anggota]</td>
                                    <td>$row[jenis_kelamin]</td>
                                    <td>$row[alamat_anggota]</td>                                                                                                                                       
                                    <td>$row[telepon_anggota]</td>
                                    <td> <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editAnggota$nomor'>
                                        <i class='fas fa-edit'></i>
                                        </button>                                                                                                                                                                           
                                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapusAnggota$nomor'>
                                        <i class='fas fa-trash'></i>
                                        </button>
                                    </td>                                                                                                                                                                            
                                    </tr>
                                    <div class='modal fade' id='hapusAnggota$nomor' tabindex='-1' aria-labelledby='hapusAnggotaLabel$nomor' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h1 class='modal-title fs-5' id='hapusAnggotaLabel$nomor'>Konfirmasi</h1>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Anda yakin akan menghapus data ini?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                    <form method='POST' action='../public/index.php?action=deleteAnggota'>
                                                        <input type='hidden' name='id_anggota' value='$row[id_anggota]'>
                                                        <button type='submit' class='btn btn-danger'>Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='editAnggota$nomor' tabindex='-1' aria-labelledby='editAnggotaLabel$nomor' aria-hidden='true' data-bs-backdrop='static' data-bs-keyboard='false'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <form method='POST' action='../public/index.php?action=updateAnggota'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='editAnggotaLabel$nomor'>Edit Data Anggota</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='mb-3'>
                                                            <label for='id-anggota-$nomor' class='form-label'>ID Anggota</label>
                                                            <input type='text' readonly class='form-control' id='id-anggota-$nomor' name='id_anggota' value='$row[id_anggota]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='nama-$nomor' class='form-label'>Nama</label>
                                                            <input type='text' class='form-control' id='nama-$nomor' name='nama_anggota' value='$row[nama_anggota]'>
                                                        </div>                                                        
                                                        <div class='mb-3'>
                                                            <label for='jenis-kelamin-$nomor' class='form-label'>Jenis Kelamin</label>
                                                            <input type='text' class='form-control' id='jenis-kelamin-$nomor' name='jenis_kelamin' value='$row[jenis_kelamin]'>
                                                        </ ```html
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='alamat-$nomor' class='form-label'>Alamat</label>
                                                            <input type='text' class='form-control' id='alamat-$nomor' name='alamat_anggota' value='$row[alamat_anggota]'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='telepon-$nomor' class='form-label'>Nomor Telepon</label>
                                                            <input type='text' class='form-control' id='telepon-$nomor' name='telepon_anggota' value='$row[telepon_anggota]'>
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
                text: 'Berhasil menambah anggota!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('&status=addsuccess') > -1) {
                history.replaceState(null, null, window.location.href.split('&')[0]);
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
            if (window.location.href.indexOf('&status=success') > -1) {
                history.replaceState(null, null, window.location.href.split('&')[0]);
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
            if (window.location.href.indexOf('&status=deleted') > -1) {
                history.replaceState(null, null, window.location.href.split('&')[0]);
            }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
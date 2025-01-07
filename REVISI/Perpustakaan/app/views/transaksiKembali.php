<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Kembali</title>
    <link href="../../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="color:white ; margin-left:5px">Admin Perpustakaan</a>
        </div>
    </nav>
</header>
<body>    
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <div class="list-group">                    
                    <a href="index.php" class="list-group-item list-group-item-action">Daftar Buku</a>
                    <a href="index.php?action=daftarAnggota" class="list-group-item list-group-item-action">Daftar Anggota</a>
                    <a href="index.php?action=peminjamanBuku" class="list-group-item list-group-item-action">Peminjaman</a>
                    <a href="index.php?action=riwayatTransaksiPinjam" class="list-group-item list-group-item-action">Transaksi Pinjam</a>   
                    <a href="index.php?action=riwayatTransaksiKembali" class="list-group-item list-group-item-action" style="color: white; background-color:rgb(0, 0, 0);">Transaksi Kembali</a>
                </div>
            </div>
            <div class="col-sm-10">
                <diV class="row mb-3">
                    <h2 class="title text-center mb-3"><b>Riwayat Transaksi Pengembalian</b></h2>
                </diV>                
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
                        <?php                        
                        $query = "select * from viewTransKembali";
                        $nomor = 1;
                        foreach ($transKembaliList as $row) {
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
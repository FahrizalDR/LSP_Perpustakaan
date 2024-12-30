<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card text-center" style="width: 30rem;">
                <div class="card-body">
                    <h2>Selamat Datang!</h2>                    
                    <p class="card-text">Silahkan pilih halaman login sesuai dengan status Anda</p>
                </div>
                <hr>
                <div class="card-body">
                    <a class="btn btn-primary" href="sign/admin/signIn.php">Admin</a>
                    <a class="btn btn-primary" href="sign/member/signIn.php">Member</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'logoutsuccess'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Terimakasih!',
                text: 'Silahkan Datang Kembali',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=logoutsuccess') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();

//Untuk ketika anggota sudah login, tidak bisa kembali ke halaman login, kecuali logout
if (isset($_SESSION["signIn"])) {
    header("Location: ../dashboardMember/dashboardMember.php");
    exit;
}

require "../../sistemLogin/koneksi.php";

if (isset($_POST["signIn"])) {

    $nama = $_POST["nama_anggota"];
    $password = $_POST["password_anggota"];


    $result = mysqli_query($connect, "SELECT * FROM anggota WHERE nama_anggota = '$nama'");

    if (mysqli_num_rows($result) === 1) {
        //cek pw 
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password_anggota"])) {
            // SET SESSION 
            $_SESSION["signIn"] = true;
            $_SESSION["anggota"] = ["id_anggota" => $row["id_anggota"], "nama_anggota" => $nama,];
            header("Location: ../../dashboardMember/dashboardMember.php?status=loginsuccess");
            exit;
        }
    }
    $error = true;        
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card" style="width: 30rem;">
                <h2 class="text-center fw-bold pt-3">Member Sign In</h2>
                <hr>
                <form action="" method="post" class="row g-3 p-4 needs-validation" novalidate>
                    <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                    <div class="input-group mt-0">
                        <input type="text" class="form-control" name="nama_anggota" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Masukkan nama anda!
                        </div>
                    </div>
                    <label for="validationCustom02" class="form-label">Password</label>
                    <div class="input-group mt-0">
                        <input type="password" class="form-control" id="validationCustom02" name="password_anggota"
                            required>
                        <div class="invalid-feedback">
                            Masukkan Password anda!
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit" name="signIn">Sign In</button>
                        <a class="btn btn-danger" href="../../loginPage.php">Batal</a>
                    </div>
                    <p>Belum punya akun? <a href="signUp.php" class="text-decoration-none text-primary">Sign
                            Up</a></p>
                </form>
                <?php if (isset($error)): ?>
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-danger" role="alert" style="width: 28rem;">Nama Lengkap / Password tidak
                            sesuai!
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <script>
        // Jika status ada di URL, tampilkan SweetAlert
        <?php if (isset($_GET['status']) && $_GET['status'] == 'signupsuccess'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Anda telah terdaftar!',
                showConfirmButton: false,
                timer: 2000 // Menghilang setelah 2 detik
            });

            // Hapus parameter URL
            if (window.location.href.indexOf('?status=signupsuccess') > -1) {
                history.replaceState(null, null, window.location.href.split('?')[0]);
            }
        <?php endif; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
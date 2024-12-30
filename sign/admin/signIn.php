<?php
session_start();

if (isset($_SESSION["signIn"])) {
    header("Location: ../../dashboardAdmin/dashboardAdmin.php");
    exit;
}

require "../../sistemLogin/koneksi.php";

if (isset($_POST["signIn"])) {

    $nama = $_POST["nama_admin"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama' AND password_admin = '$password' ");

    if (mysqli_num_rows($result) === 1) {
        //SET SESSION 
        $_SESSION["signIn"] = true;
        $_SESSION["admin"]["nama_admin"] = $nama;
        header("Location: ../../dashboardAdmin/dashboardAdmin.php?status=loginsuccess");
        exit;
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

</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card" style="width: 30rem;">
                <h2 class="text-center fw-bold pt-3">Admin Sign In</h2>
                <hr>
                <form action="" method="post" class="row g-3 p-4 needs-validation" novalidate>
                    <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                    <div class="input-group mt-0">
                        <input type="text" class="form-control" name="nama_admin" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Masukkan nama anda!
                        </div>
                    </div>
                    <label for="validationCustom02" class="form-label">Password</label>
                    <div class="input-group mt-0">
                        <input type="password" class="form-control" id="validationCustom02" name="password" required>
                        <div class="invalid-feedback">
                            Masukkan Password anda!
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit" name="signIn">Sign In</button>
                        <a class="btn btn-danger" href="../../loginPage.php">Batal</a>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
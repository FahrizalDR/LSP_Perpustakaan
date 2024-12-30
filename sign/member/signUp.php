<?php
require "../../sistemLogin/koneksi.php";
if (isset($_POST["signUp"])) {

  if (signUp($_POST) > 0) {    
    echo "<script>    
    window.location.href = 'signIn.php?status=signupsuccess';
    </script>";
  } else {    
    echo "<script>
    alert('Sign Up gagal!')
    </script>";
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card" style="width: 30rem;">
                <h2 class="pt-3 text-center fw-bold">Sign Up</h2>
                <hr>
                <form action="" method="post" class="row g-3 p-4 needs-validation" novalidate>

                    <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                    <div class="input-group mt-0">
                        <input type="text" class="form-control" name="nama" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Nama Lengkap wajib diisi!
                        </div>
                    </div>

                    <label for="validationCustom01" class="form-label">Alamat</label>
                    <div class="input-group mt-0">
                        <input type="text" class="form-control" name="alamat" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Alamat wajib diisi!
                        </div>
                    </div>

                    <label for="validationCustom02" class="form-label">Password</label>
                    <div class="input-group mt-0">
                        <input type="password" class="form-control" id="validationCustom02" name="password" required>
                        <div class="invalid-feedback">
                            Password wajib diisi!
                        </div>
                    </div>

                    <label for="validationCustom01" class="form-label">Nomor Telepon</label>
                    <div class="input-group mt-0">
                        <input type="text" class="form-control" name="no_tlp" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            No telepon wajib diisi!
                        </div>
                    </div>

                    <div class="col input-group mb-2">
                        <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                        <select class="form-select" id="inputGroupSelect01" name="jenis_kelamin">
                            <option selected>Choose</option>
                            <option value="Laki laki">Laki laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit" name="signUp">Sign Up</button>
                        <input type="reset" class="btn btn-warning text-light" value="Reset">
                    </div>
                    <p>Sudah punya akun? <a href="signIn.php" class="text-decoration-none text-primary">Sign
                            In</a>
                    </p>
                </form>
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
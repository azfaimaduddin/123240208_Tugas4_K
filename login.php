<?php
include 'components/components.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('login') ?>
</head>

<body>

  <body class="bg-light">
    <div class="container-fluid vh-100">
      <div class="row h-100">

        <!-- Left Panel -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center text-white"
          style="background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;">
          <div class="px-5 d-flex flex-column justify-content-between h-100 my-5">
            <h1 class="fw-bold">Login Page</h1>
            <p class="mt-3">Langsung saja login, untuk mengakses komentar acara ini.</p>
          </div>
        </div>

        <!-- Right Panel -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
          <div class="w-75" style="max-width: 400px;">
            <!-- PESAN STATUS -->
            <?php
            if (isset($_GET['status'])) {
              listAlert($_GET['status']);
            }
            ?>
            <h2 class="fw-bold mb-2">Login Dulu!</h2>
            <p class="text-muted mb-4">Silahkan login, untuk mengakses komentar acara ini.</p>

            <form action="logic/auth.php" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Pasword">
              </div>
              <button type="submit" class="btn btn-dark w-100 mb-3">Login</button>
              <div class="text-center text-muted">
                Tidak ada akun? <a href="register.php" class="text-decoration-none">Bikin disini</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </body>

</html>
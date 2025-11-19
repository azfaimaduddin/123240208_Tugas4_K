<?php
include 'components/components.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Register Page') ?>
</head>

<body class="bg-light">
  <div class="container-fluid vh-100">
    <div class="row h-100">

      <div class="col-md-6 d-none d-md-flex flex-column justify-content-center text-white"
        style="background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;">
        <div class="px-5 d-flex flex-column justify-content-between h-100 my-5">
          <h1 class="fw-bold">Register Page</h1>
          <p class="mt-3">Langsung bikin akun, dan gass login.</p>
        </div>
      </div>

      <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
        <div class="w-75" style="max-width: 400px;">
            
          <?php
          if (isset($_GET['status'])) {
              listAlert($_GET['status']);
          }
          ?>

          <h2 class="fw-bold mb-2">Silahkan buat Akun!</h2>
          <p class="text-muted mb-4">Untuk login, perlu akun. Jadi buatlah akun dulu.</p>

          <form action="logic/auth.php" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="mb-5">
              <label for="confirm" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn btn-dark w-100 mb-3">Register</button>
            <div class="text-center text-muted">
              Sudah ada akun? <a href="login.php" class="text-decoration-none">Langsung Login Saja</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php footer() ?>
</body>
</html>
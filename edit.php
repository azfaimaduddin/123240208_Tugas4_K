<?php
include 'components/components.php';
include 'config/koneksi.php';
include 'components/session_protected.php';

// Validasi parameter URL
if(!isset($_GET['id_peserta']) || !isset($_GET['id_tim'])){
    header("Location: index.php");
    exit;
}

$id_peserta = $_GET['id_peserta'];
$id_tim = $_GET['id_tim'];

// Ambil data peserta
$query_peserta = mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_peserta = $id_peserta");
$peserta = mysqli_fetch_assoc($query_peserta);

// Security Check: Jika yang mau edit bukan pemiliknya, tendang
if($_SESSION['id_user'] != $peserta['id_user']){
    header("Location: pendaftaran.php?id_tim=$id_tim"); // Redirect balik
    exit;
}

// Ambil data tim
$tim = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tim WHERE id_tim = $id_tim"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Edit Peserta')  ?> 
</head>

<body>
  <?php navbar() ?>

  <section class="container mt-3 w-100">
    <div class="d-flex gap-3 bg-body-secondary p-3 rounded">

      <div class="w-25">
        <div class="mb-2">
          <img src="<?= $tim['gambar_url'] ?>" 
               alt="<?= $tim['nama'] ?>" 
               class="object-fit-cover w-100 rounded mb-2 border">
          
          <p class="m-0 fw-semibold fs-4"><?= $tim['nama'] ?></p>
        </div>
      </div>

      <div class="flex-grow-1">
        
        <a href="pendaftaran.php?id_tim=<?= $id_tim ?>">
          <button class="btn btn-dark mb-3">Kembali</button>
        </a>

        <h3 class="mb-2">Update Data Peserta Tim <?= $tim['nama'] ?></h3>

        <form action="logic/update.data.php" method="POST">

          <input type="hidden" name="id_peserta" value="<?= $peserta['id_peserta'] ?>">
          <input type="hidden" name="id_tim" value="<?= $id_tim ?>">

          <div class="mb-3">
            <label for="nama" class="form-label">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $peserta['nama'] ?>" required>
          </div>

          <div class="mb-3">
            <label for="nohp" class="form-label">Nomor Handphone :</label>
            <input type="text" class="form-control" id="nohp" name="nomer_hp" value="<?= $peserta['nomer_hp'] ?>" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $peserta['email'] ?>" required>
          </div>

          <button type="submit" class="btn btn-dark">Update Data Peserta</button>

        </form>

      </div>

    </div>
  </section>
  
  <?php footer() ?>
</body>
</html>
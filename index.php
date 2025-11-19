<?php
include 'components/components.php';
include 'config/koneksi.php';
include 'components/session_protected.php';

$data_tim = mysqli_query($koneksi, "SELECT * FROM tim");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Pilih Tim')  ?>
</head>

<body>
  <?php navbar() ?>

  <section class="container my-5">
    <main class="d-flex justify-content-center gap-5 flex-wrap">
      
      <?php
      while ($tim = mysqli_fetch_array($data_tim)) {
        card($tim);
      }
      ?>
      
    </main>
  </section>

  <?php footer() ?>
</body>
</html>
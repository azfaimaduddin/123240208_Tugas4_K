<?php
include 'components/components.php';
include 'config/koneksi.php';
include 'components/session_protected.php';

if(!isset($_POST['id_tim']) && !isset($_GET['id_tim'])){
    header("Location: index.php");
    exit;
}

$id_tim = $_POST['id_tim'] ?? $_GET['id_tim'];

// Ambil data tim
$query_tim = mysqli_query($koneksi, "SELECT * FROM tim WHERE id_tim = $id_tim");
$tim = mysqli_fetch_assoc($query_tim);

// Ambil data peserta
$data_peserta = mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_tim = $id_tim");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Pendaftaran Tim ' . $tim['nama'])  ?>
</head>

<body>
  <?php navbar() ?>

  <section class="container mt-3 w-100">
    <div class="d-flex gap-3 bg-body-secondary p-3 flex-column flex-md-row">

      <div class="w-100 w-md-25" style="flex: 1;">
        <div class="mb-2 text-center text-md-start">
          <img src="<?= $tim['gambar_url'] ?>" 
               alt="<?= $tim['nama'] ?>" 
               class="object-fit-cover w-100 rounded mb-2 border" style="max-height: 300px;">
          <p class="m-0 fw-semibold fs-4"><?= $tim['nama'] ?></p>
        </div>

        <hr>
        <h5>Tambah Data Peserta</h5>
        <form action="logic/create.data.php" method="POST">
          <input type="hidden" name="id_tim" value="<?= $id_tim ?>">

          <div class="mb-3">
            <label for="nama" class="form-label">Nama :</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
          </div>

          <div class="mb-3">
            <label for="nohp" class="form-label">Nomor Handphone :</label>
            <input type="text" class="form-control" id="nohp" name="nomer_hp" placeholder="Masukkan No HP" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
          </div>

          <button type="submit" class="btn btn-dark w-100">Tambah Data</button>
        </form>
      </div>

      <div class="flex-grow-1" style="flex: 2;">
        <h3 class="mb-2">Data Tim - <?= $tim['nama'] ?></h3>

        <div class="table-responsive">
            <table class="table table-striped table-hover bg-white rounded">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No HP</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
              </thead>
    
              <tbody>
                <?php
                $no = 1;
                if(mysqli_num_rows($data_peserta) > 0) {
                    while ($p = mysqli_fetch_assoc($data_peserta)) { 
                        // CEK OTORITAS: Apakah user yang login adalah pembuat data ini?
                        $is_owner = ($_SESSION['id_user'] == $p['id_user']);
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['nomer_hp'] ?></td>
                        <td><?= $p['email'] ?></td>
                        <td class="d-flex gap-2">
                            
                          <?php if($is_owner): ?>
                              <form action="edit.php" method="GET">
                                <input type="hidden" name="id_peserta" value="<?= $p['id_peserta'] ?>">
                                <input type="hidden" name="id_tim" value="<?= $id_tim ?>">
                                <button class="btn btn-warning btn-sm">Edit</button>
                              </form>
    
                              <form action="logic/delete.data.php" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                <input type="hidden" name="id_peserta" value="<?= $p['id_peserta'] ?>">
                                <input type="hidden" name="id_tim" value="<?= $id_tim ?>">
                                <button class="btn btn-danger btn-sm">Delete</button>
                              </form>
                          <?php else: ?>
                              <span class="badge text-bg-secondary">No Access</span>
                          <?php endif; ?>
    
                        </td>
                      </tr>
                    <?php } 
                } else {
                    echo '<tr><td colspan="5" class="text-center">Tidak ada Data</td></tr>';
                }
                ?>
              </tbody>
            </table>
        </div>

      </div>
    </div>
  </section>

  <?php footer() ?>
</body>

</html>

<?php
include '../config/koneksi.php';
include '../components/session_protected.php';

if (isset($_POST['id_peserta']) && isset($_POST['id_tim'])) {

    $id_peserta = $_POST['id_peserta'];
    $id_tim = $_POST['id_tim'];
    $id_user_login = $_SESSION['id_user'];

    // Query hapus dengan validasi kepemilikan (AND id_user = ...)
    $delete = mysqli_query($koneksi, "DELETE FROM peserta WHERE id_peserta = $id_peserta AND id_user = $id_user_login");

    if(mysqli_affected_rows($koneksi) > 0){
        // Berhasil hapus
        header("Location: ../pendaftaran.php?id_tim=$id_tim");
    } else {
        // Gagal hapus (mungkin bukan pemiliknya)
        header("Location: ../pendaftaran.php?id_tim=$id_tim&error=akses_ditolak");
    }
    exit;

} else {
    header("Location: ../index.php?status=hapus_gagal");
    exit;
}
?>
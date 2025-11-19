<?php
include '../config/koneksi.php';
include '../components/session_protected.php';

if (
    isset($_POST['id_tim']) &&
    isset($_POST['nama']) &&
    isset($_POST['nomer_hp']) &&
    isset($_POST['email'])
) {

    $id_tim = $_POST['id_tim'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nomer_hp'];
    $email = $_POST['email'];
    
    $id_user = $_SESSION['id_user']; 

    $query = mysqli_query($koneksi, "
        INSERT INTO peserta(nama, nomer_hp, email, id_user, id_tim)
        VALUES ('$nama', '$nohp', '$email', '$id_user', '$id_tim')
    ");

    if ($query) {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=sukses_tambah");
        exit;
    } else {
        echo "Gagal insert: " . mysqli_error($koneksi);
    }

} else {
    header("Location: ../index.php?status=input_tidak_lengkap");
    exit;
}
?>

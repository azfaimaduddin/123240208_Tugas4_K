<?php
include '../config/koneksi.php';
include '../components/session_protected.php';

if (
    isset($_POST['id_peserta']) &&
    isset($_POST['id_tim']) &&
    isset($_POST['nama']) &&
    isset($_POST['nomer_hp']) &&
    isset($_POST['email'])
) {

    $id_peserta = $_POST['id_peserta'];
    $id_tim = $_POST['id_tim'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nomer_hp'];
    $email = $_POST['email'];
    
    $id_user_login = $_SESSION['id_user'];

    $update = mysqli_query($koneksi, "
        UPDATE peserta SET 
            nama = '$nama',
            nomer_hp = '$nohp',
            email = '$email'
        WHERE id_peserta = $id_peserta AND id_user = $id_user_login
    ");

    if(mysqli_affected_rows($koneksi) > 0){
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=sukses_update");
    } else {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=tidak_ada_perubahan");
    }
    exit;

} else {
    header("Location: ../index.php?status=input_tidak_lengkap");
    exit;
}
?>

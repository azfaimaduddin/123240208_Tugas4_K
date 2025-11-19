<?php
include '../config/koneksi.php';
session_start();

// LOGIN LOGIC
if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['confirm'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($cek);

    if (!$data) {
        header("Location: ../login.php?status=gagal_login");
        exit;
    }

    if (!password_verify($password, $data['password'])) {
        header("Location: ../login.php?status=gagal_login");
        exit;
    }

    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];

    header("Location: ../index.php");
    exit;
}

// REGISTER LOGIC
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        header("Location: ../register.php?status=password_tidak_sama");
        exit;
    }

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        header("Location: ../register.php?status=gagal_mendaftar");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO users(username,password) VALUES('$username','$hash')");

    header("Location: ../login.php?status=berhasil_mendaftar");
    exit;
}
?>
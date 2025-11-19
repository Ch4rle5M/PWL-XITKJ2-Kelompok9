<?php
session_start();
require_once '../../db/db-con.php';

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $pass     = $_POST['password'];
    $confPass = $_POST['confirm_password'];

    if ($pass !== $confPass) {
        $_SESSION['error'] = "Password tidak sama!";
        header("Location: /pages/signup.php");
        exit();
    }

    $cek = $conn->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
    $cek->bind_param("ss", $username, $email);
    $cek->execute();
    
    if ($cek->get_result()->num_rows > 0) {
        $_SESSION['error'] = "Username atau Email sudah terpakai!";
        header("Location: /pages/signup.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, 'player')");
    $stmt->bind_param("sss", $username, $email, $pass);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Akun berhasil dibuat! Silakan Login.";
        header("Location: /pages/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal daftar: " . $conn->error;
        header("Location: /pages/signup.php");
        exit();
    }
}
?>
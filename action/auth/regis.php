<?php
// Selalu mulai session di paling atas
session_start();

// Panggil koneksi database kamu
require_once '../../db/db-con.php'; // Sesuaikan path jika perlu

// Pastikan ini adalah request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Jika bukan POST, tendang ke homepage
    header("Location: ../../homepage.php");
    exit;
}

// 1. Ambil data dari form
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// 2. Validasi dasar
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = "Semua field wajib diisi!";
    header("Location: ../../signup.php"); // Arahkan kembali ke signup
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = "Password dan Konfirmasi Password tidak cocok!";
    header("Location: ../../signup.php");
    exit;
}

// 3. INI BAGIAN PENTING: Cek duplikat username atau email
try {
    // Siapkan query untuk mengecek username ATAU email
    $sql_check = "SELECT username, email FROM user WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Ada duplikat!
        $existing_user = $result->fetch_assoc();

        if ($existing_user['username'] === $username) {
            // Username sudah ada
            $_SESSION['error'] = "Username '{$username}' sudah terpakai. Silakan gunakan username lain.";
        } else if ($existing_user['email'] === $email) {
            // Email sudah ada
            $_SESSION['error'] = "Email '{$email}' sudah terdaftar. Silakan gunakan email lain.";
        }
        
        $stmt_check->close();
        header("Location: ../../signup.php"); // Kembalikan ke halaman signup
        exit;
    }
    
    $stmt_check->close();

    // 4. Jika lolos pengecekan (tidak ada duplikat), lanjut insert user baru
    
    // HASH password sebelum disimpan! JANGAN SIMPAN PLAINTEXT
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt_insert->execute()) {
        // Registrasi berhasil
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../../login.php"); // Arahkan ke halaman login
        exit;
    } else {
        // Gagal insert
        $_SESSION['error'] = "Terjadi kesalahan pada server. Gagal mendaftar.";
        header("Location: ../../signup.php");
        exit;
    }

    $stmt_insert->close();

} catch (Exception $e) {
    $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
    header("Location: ../../signup.php");
    exit;
}

$conn->close();

?>
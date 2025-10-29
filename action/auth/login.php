<?php
session_start();

require_once '../../db/db-con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password tidak boleh kosong.";
        header("Location: ../../login.php");
        exit;
    }
    $sql = "SELECT id, username, password FROM user WHERE username = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                
                session_regenerate_id(true);
                
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: ../../homepage.php");
                exit;
            }
        }
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: ../../login.php");
        exit;

    } else {
        $_SESSION['error'] = "Terjadi kesalahan pada server. Silakan coba lagi.";
        header("Location: ../../login.php");
        exit;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../../login.php");
    exit;
}
?>  
<?php
session_start();

require_once '../../db/db-con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password tidak boleh kosong.";
        header("Location: ../../pages/login.php");
        exit;
    }

    $sql = "SELECT id, username, password, role FROM user WHERE username = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                
                session_regenerate_id(true);
                
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: /pages/admin.php");
                } else {
                    header("Location: /pages/profile.php"); 
                }
                exit;
            }
        }
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: ../../pages/login.php");
        exit;

    } else {
        $_SESSION['error'] = "Terjadi kesalahan pada server.";
        header("Location: ../../pages/login.php");
        exit;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../../pages/login.php");
    exit;
}
?>
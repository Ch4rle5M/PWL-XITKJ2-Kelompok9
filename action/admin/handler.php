<?php
session_start();
require_once '../../db/db-con.php';

if (!isset($_SESSION['user_id'])) { header("Location: /pages/login.php"); exit(); }

$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM user WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user || $user['role'] !== 'admin') { die("AKSES DITOLAK."); }

function redirectBack($msg, $type = 'success') {
    $_SESSION['flash_msg'] = ['text' => $msg, 'type' => $type];
    header("Location: /pages/admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_chall'])) {
    $id    = $_POST['custom_id'];
    $title = $_POST['title'];
    $desc  = $_POST['desc'];
    $flag  = $_POST['flag'];
    $score = $_POST['score'];
    $cat   = $_POST['category'];
    
    $dbImagePath = '/assets/flag';

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image_file']['name'];
        $filetmp  = $_FILES['image_file']['tmp_name'];
        $ext      = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $newFilename = time() . '_' . rand(100,999) . '.' . $ext;
            $uploadDir = '../../assets/uploads/';
            $destination = $uploadDir . $newFilename;

            if (move_uploaded_file($filetmp, $destination)) {
                $dbImagePath = '/assets/uploads/' . $newFilename;
            } else {
                redirectBack("Gagal mengupload gambar ke folder assets.", "error");
            }
        } else {
            redirectBack("Format gambar tidak valid! (Cuma boleh JPG, PNG, WEBP)", "error");
        }
    }

    $cek = $conn->query("SELECT challenge_id FROM challenges WHERE challenge_id = '$id'");
    if ($cek->num_rows > 0) {
        redirectBack("Gagal: ID '$id' sudah dipakai!", "error");
    }

    $sql = "INSERT INTO challenges (challenge_id, challenge_name, description, flag, score, category, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $id, $title, $desc, $flag, $score, $cat, $dbImagePath);

    if ($stmt->execute()) {
        redirectBack("Challenge Berhasil Ditambahkan!");
    } else {
        redirectBack("Gagal Database: " . $conn->error, "error");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_chall'])) {
    $delId = $_POST['del_id'];
    $stmt = $conn->prepare("DELETE FROM challenges WHERE challenge_id = ?");
    $stmt->bind_param("s", $delId);
    if ($stmt->execute()) { redirectBack("Challenge berhasil dihapus."); } 
    else { redirectBack("Gagal menghapus.", "error"); }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_user'])) {
    $targetId = (int)$_POST['target_user_id'];
    $type = $_POST['action_type'];
    if ($type === 'promote') $conn->query("UPDATE user SET role='admin' WHERE id=$targetId");
    if ($type === 'demote') $conn->query("UPDATE user SET role='player' WHERE id=$targetId");
    if ($type === 'kick') $conn->query("DELETE FROM user WHERE id=$targetId");
    redirectBack("Action user berhasil.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_user'])) {
    $targetId   = (int)$_POST['target_user_id'];
    $actionType = $_POST['action_type'];

    if ($actionType === 'promote') {
        $conn->query("UPDATE user SET role='admin' WHERE id=$targetId");
        redirectBack("User berhasil diangkat jadi Admin!");
    } 
    elseif ($actionType === 'demote') {
        $conn->query("UPDATE user SET role='player' WHERE id=$targetId");
        redirectBack("User diturunkan jadi Player.");
    } 
    elseif ($actionType === 'kick') {
        $conn->query("DELETE FROM user WHERE id=$targetId");
        redirectBack("User berhasil di-kick (Hapus).");
    }
    elseif ($actionType === 'reset_pass') {
        $defaultPass = '123456';
        
        $conn->query("UPDATE user SET password='$defaultPass' WHERE id=$targetId");
        redirectBack("Password user berhasil di-reset jadi: 123456");
    }
}
?>
<?php
session_start();
require_once __DIR__ . '/../../db/db-con.php';

if (!isset($_SESSION['user_id'])) { header("Location: /pages/login.php"); exit(); }

function uploadFile($fileInputName) {
    if (empty($_FILES[$fileInputName]['name'])) return null;
    if ($_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) return "ERROR_CODE_" . $_FILES[$fileInputName]['error']; 

    $projectRoot = __DIR__ . '/../../'; 
    $targetDir = $projectRoot . 'assets/uploads/';

    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0777, true)) return "ERROR_MKDIR"; 
    }

    $cleanName = preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES[$fileInputName]['name']));
    $fileName = time() . '_' . $cleanName;
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFilePath)) {
        return $fileName;
    }
    return "ERROR_MOVE"; 
}


if (isset($_POST['add_chall'])) {
    $id = $_POST['custom_id'];
    $title = $_POST['title'];
    $cat = $_POST['category'];
    $desc = $_POST['desc'];
    $flag = $_POST['flag'];
    $score = $_POST['score'];

    $imagePath = uploadFile('image_file');
    if ($imagePath && strpos($imagePath, 'ERROR') !== false) $imagePath = null;

    $finalFilePath = null;
    $uploadedFile = uploadFile('attachment_file'); 

    if ($uploadedFile && strpos($uploadedFile, 'ERROR') === false) {
        $finalFilePath = '/assets/uploads/' . $uploadedFile;
    } elseif (!empty($_POST['attachment_url'])) {
        $finalFilePath = $_POST['attachment_url'];
    }

    $sql = "INSERT INTO challenges (challenge_id, challenge_name, category, description, flag, score, image_path, file_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiss", $id, $title, $cat, $desc, $flag, $score, $imagePath, $finalFilePath);

    if ($stmt->execute()) {
        $_SESSION['flash_msg'] = ['type' => 'success', 'text' => 'Soal berhasil ditambahkan!'];
    } else {
        $_SESSION['flash_msg'] = ['type' => 'error', 'text' => 'Gagal DB: ' . $stmt->error];
    }
    
    header("Location: /pages/admin.php");
    exit();
}

if (isset($_POST['delete_chall'])) {
    $id = $_POST['del_id'];
    $q = $conn->query("SELECT image_path, file_path FROM challenges WHERE challenge_id = '$id'");
    $data = $q->fetch_assoc();
    $projectRoot = __DIR__ . '/../../'; 

    if ($data) {
        if (!empty($data['image_path']) && !str_starts_with($data['image_path'], 'http')) {
            $f = $projectRoot . ltrim($data['image_path'], '/');
            if (file_exists($f)) unlink($f);
        }
        if (!empty($data['file_path']) && !str_starts_with($data['file_path'], 'http')) {
         $f = $projectRoot . 'assets/uploads/' . basename($data['file_path']);
        if (file_exists($f)) unlink($f);
}
    }

    $stmt = $conn->prepare("DELETE FROM challenges WHERE challenge_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    
    $_SESSION['flash_msg'] = ['type' => 'success', 'text' => 'Soal dihapus.'];
    header("Location: /pages/admin.php");
    exit();
}

if (isset($_POST['action_type'])) {
    $targetId = $_POST['target_user_id'];
    $action = $_POST['action_type'];
    
    if ($action === 'kick') $conn->query("DELETE FROM user WHERE id = $targetId");
    elseif ($action === 'reset_pass') {
        $newPass = password_hash("123456", PASSWORD_DEFAULT); 
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $newPass, $targetId);
        $stmt->execute();
    } elseif ($action === 'promote') $conn->query("UPDATE user SET role = 'admin' WHERE id = $targetId");
    elseif ($action === 'demote') $conn->query("UPDATE user SET role = 'player' WHERE id = $targetId");
    
    $_SESSION['flash_msg'] = ['type' => 'success', 'text' => 'Action success.'];
    header("Location: /pages/admin.php");
    exit();
}
?>
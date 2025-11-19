<?php
session_start();
header('Content-Type: application/json');
error_reporting(0); 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Login dulu bos.']);
    exit;
}

$dbPath = __DIR__ . '/../../db/db-con.php';

if (!file_exists($dbPath)) {
    echo json_encode(['status' => 'error', 'message' => 'DB Path Salah! Cek file secret/flag.php']);
    exit;
}

require_once $dbPath;

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['challengeId']) && isset($input['flag'])) {
    $challId = $input['challengeId'];
    $flagInput = trim($input['flag']);
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT flag, score FROM challenges WHERE challenge_id = ?");
    $stmt->bind_param("s", $challId); 
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if (trim($row['flag']) === $flagInput) {
            $cek = $conn->prepare("SELECT id FROM user_solves WHERE user_id = ? AND challenge_id = ?");
            $cek->bind_param("is", $userId, $challId);
            $cek->execute();
            
            if ($cek->get_result()->num_rows > 0) {
                echo json_encode(['status' => 'already', 'message' => 'Udah pernah solve!']);
            } else {
                $ins = $conn->prepare("INSERT INTO user_solves (user_id, challenge_id) VALUES (?, ?)");
                $ins->bind_param("is", $userId, $challId);
                if ($ins->execute()) {
                    echo json_encode(['status' => 'correct', 'message' => 'Flag Benar! +' . $row['score']]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal insert DB']);
                }
            }
        } else {
            echo json_encode(['status' => 'incorrect', 'message' => 'Flag Salah!']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Challenge ID gak ketemu']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data kosong']);
}
?>
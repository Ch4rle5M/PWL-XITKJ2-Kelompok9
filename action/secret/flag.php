<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Harus login dulu.']);
    exit;
}

require_once '/../db/db-con.php';
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['challengeId']) && isset($data['flag'])) {
    $challId = $data['challengeId'];
    $flagInput = trim($data['flag']);
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT flag, score FROM challenges WHERE challenge_id = ?");
    $stmt->bind_param("s", $challId); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['flag'] === $flagInput) {
            
            $cek = $conn->prepare("SELECT id FROM user_solves WHERE user_id = ? AND challenge_id = ?");
            $cek->bind_param("is", $userId, $challId);
            $cek->execute();
            
            if ($cek->get_result()->num_rows > 0) {
                echo json_encode(['status' => 'already', 'message' => 'Sudah pernah solve bang!']);
            } else {
                $ins = $conn->prepare("INSERT INTO user_solves (user_id, challenge_id) VALUES (?, ?)");
                $ins->bind_param("is", $userId, $challId);
                
                if ($ins->execute()) {
                    echo json_encode(['status' => 'correct', 'message' => 'Flag Benar! +' . $row['score']]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal save database.']);
                }
            }
        } else {
            echo json_encode(['status' => 'incorrect', 'message' => 'Flag Salah!']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Challenge ID tidak valid.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data kurang.']);
}
?>
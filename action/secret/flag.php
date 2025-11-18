<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Anda harus login untuk submit flag.'
    ]);
    exit;
}

require_once '../db/db-con.php';

$dataDariKlien = json_decode(file_get_contents('php://input'), true);

$response = [
    'status' => 'error',
    'message' => 'Data tidak lengkap.'
];

if (isset($dataDariKlien['challengeId']) && isset($dataDariKlien['flag'])) {
    
    $challengeId = $dataDariKlien['challengeId'];
    $submittedFlag = $dataDariKlien['flag'];
    $userId = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("SELECT flag, score FROM challenges WHERE challenge_id = ?");
    $stmt->bind_param("s", $challengeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $challenge = $result->fetch_assoc();
        $correctFlag = $challenge['flag'];

        if ($correctFlag === $submittedFlag) {
            $response['status'] = 'correct';
            $response['message'] = 'Flag Correct';

            $insertStmt = $conn->prepare("INSERT IGNORE INTO user_solves (user_id, challenge_id) VALUES (?, ?)");
            $insertStmt->bind_param("is", $userId, $challengeId);
            $insertStmt->execute();
            $insertStmt->close();

        } else {
            $response['status'] = 'incorrect';
            $response['message'] = 'Flag Incorrect';
        }
        
    } else {
        $response['message'] = 'Challenge tidak valid.';
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
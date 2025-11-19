<?php
session_start();
require_once '../db/db-con.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: /pages/login.php"); 
    exit(); 
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

$stmtRole = $conn->prepare("SELECT role FROM user WHERE id = ?");
$stmtRole->bind_param("i", $userId);
$stmtRole->execute();
$resRole = $stmtRole->get_result();
$userData = $resRole->fetch_assoc();

$userRole = $userData['role'] ?? 'player'; 
$stmtRole->close();


$totalScore = 0;
$solvedChallenges = [];

$sql = "SELECT c.challenge_name, c.score 
        FROM user_solves us
        JOIN challenges c ON us.challenge_id = c.challenge_id
        WHERE us.user_id = ?
        ORDER BY us.solved_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $solvedChallenges[] = $row; 
    $totalScore += $row['score'];
}
$stmt->close();
$conn->close();

$rank = "N/A"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ciphera Profile</title>
    <link rel="stylesheet" href="/styles/profile.css"/>
    <style>
        .admin-btn {
            background-color: #e74c3c !important;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

    <main class="profile-container">
        <div class="user-info">
            <p><strong>Username :</strong> <span class="username"><?php echo htmlspecialchars($username); ?></span></p>
            
            <?php if ($userRole === 'admin'): ?>
                <p><strong>Role :</strong> <span style="color: red; font-weight:bold;">ADMINISTRATOR</span></p>
            <?php endif; ?>

            <p><strong>Rank :</strong> <span class="rank"><?php echo $rank; ?></span></p>
            <p>
                <span class="star-icon">★</span> 
                <span class="score"><?php echo $totalScore; ?></span>
            </p>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="leaderboard.php"><button class="leaderboard-button">Leaderboard</button></a>
            
            <?php if ($userRole === 'admin'): ?>
                <a href="admin.php"><button class="leaderboard-button admin-btn">Admin Panel</button></a>
            <?php endif; ?>
        </div>
    </main>

    <section class="solved-challenges-section">
        <h2>Solved Challenge</h2>
        <div class="challenge-list">
             <?php if (empty($solvedChallenges)): ?>
                <p style="text-align: center; opacity: 0.7;">Belum ada challenge yang diselesaikan.</p>
            <?php else: ?>
                <?php foreach ($solvedChallenges as $challenge): ?>
                    <div class="challenge-item">
                        <p><?php echo htmlspecialchars($challenge['challenge_name']); ?></p>
                        <span class="star-icon">★</span>
                        <span class="challenge-score"><?php echo $challenge['score']; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
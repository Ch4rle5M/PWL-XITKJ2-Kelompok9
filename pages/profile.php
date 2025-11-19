<?php
session_start();
require_once '../db/db-con.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: /pages/login.php"); 
    exit(); 
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

// 1. CEK ROLE
$stmtRole = $conn->prepare("SELECT role FROM user WHERE id = ?");
$stmtRole->bind_param("i", $userId);
$stmtRole->execute();
$resRole = $stmtRole->get_result();
$userData = $resRole->fetch_assoc();
$userRole = $userData['role'] ?? 'player'; 
$stmtRole->close();

// 2. HITUNG SCORE PRIBADI & LIST CHALLENGE
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


// --- [LOGIC BARU] HITUNG RANKING ---
// Kita ambil data leaderboard (sama persis kayak query di leaderboard.php)
// Biar urutannya konsisten.
$sqlRank = "SELECT u.id, COALESCE(SUM(c.score), 0) as total_score
            FROM user u
            LEFT JOIN user_solves us ON u.id = us.user_id
            LEFT JOIN challenges c ON us.challenge_id = c.challenge_id
            GROUP BY u.id
            ORDER BY total_score DESC, u.username ASC";

$rankResult = $conn->query($sqlRank);
$rank = "N/A"; // Default kalau error

if ($rankResult) {
    $currentPosition = 1;
    // Loop semua user dari skor tertinggi
    while ($row = $rankResult->fetch_assoc()) {
        // Kalau ID di list sama dengan ID user yang login
        if ($row['id'] == $userId) {
            $rank = "#" . $currentPosition;
            break; // Stop looping, udah ketemu
        }
        $currentPosition++;
    }
}

// Styling Warna Rank (Opsional, biar keren)
$rankColor = "white";
if ($rank == "#1") $rankColor = "#ffd700";      // Emas
elseif ($rank == "#2") $rankColor = "#c0c0c0";  // Perak
elseif ($rank == "#3") $rankColor = "#cd7f32";  // Perunggu

$conn->close();
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
        /* Animasi dikit buat rank */
        .rank { font-weight: 900; font-size: 1.2em; }
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

            <p><strong>Rank :</strong> <span class="rank" style="color: <?php echo $rankColor; ?>;"><?php echo $rank; ?></span></p>
            
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
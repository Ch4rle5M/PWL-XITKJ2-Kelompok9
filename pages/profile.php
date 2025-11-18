<?php
session_start();
require_once '../db/db-con.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: /pages/login.php"); 
    exit(); 
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

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

$rank = "#?"; //belakangan sajalah

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ciphera Profile</title>
    <link rel="stylesheet" href="/styles/profile.css"/>
</head>
<body>
  <div class="navbar">
    <div class="logo">
      <a href="homepage.php"> <img src="/assets/homepage/Frame 6.png" alt="Ciphera Logo">
      </a>
    </div>
<div class="menu">
  <a href="homepage.php">Home</a>
  <a href="#learn-section">Learn</a> 
  <a href="ctf.php">CTF</a>
  <a href="community.php">Community</a>

  <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>

    <a href="profile.php">Profile   (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
    <a href="/action/auth/logout.php">Logout</a>

  <?php else: ?>

    <a href="signup.php">Sign Up</a> 
    <a href="login.php">Log In</a>

  <?php endif; ?>
</div>
  </div>

    <main class="profile-container">
        <div class="user-info">
            <p><strong>Username :</strong> <span class="username"><?php echo htmlspecialchars($username); ?></span></p>
            <p><strong>Rank :</strong> <span class="rank"><?php echo $rank; ?></span></p>
            <p>
                <span class="star-icon">★</span> 
                <span class="score"><?php echo $totalScore; ?></span>
            </p>
        </div>
        <button class="leaderboard-button">Leaderboard</button>
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
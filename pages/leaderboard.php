<?php
session_start();
require_once '../db/db-con.php';

$sql = "SELECT u.username, COALESCE(SUM(c.score), 0) as total_score
        FROM user u
        LEFT JOIN user_solves us ON u.id = us.user_id
        LEFT JOIN challenges c ON us.challenge_id = c.challenge_id
        GROUP BY u.id, u.username
        ORDER BY total_score DESC, u.username ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CIPHERA Leaderboard</title>
  <link rel="stylesheet" href="/styles/leaderboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>
      
  <main>
    <div class="leaderboard-wrapper">
        <button class="back-btn" onclick="window.location.href='profile.php'">← Back to Profile</button>

        <section class="leaderboard-container">
            <div class="leaderboard-title">Leaderboard</div>

            <ul class="leaderboard-list">
                <?php 
                if ($result && $result->num_rows > 0):
                    $rank = 1;
                    while($row = $result->fetch_assoc()): 
                        $rankClass = "rank";
                        if ($rank == 1) $rankClass .= " rank-1";
                        elseif ($rank == 2) $rankClass .= " rank-2";
                        elseif ($rank == 3) $rankClass .= " rank-3";
                ?>
                    <li class="leaderboard-entry">
                        <span class="<?php echo $rankClass; ?>">#<?php echo $rank; ?></span> 
                        <span class="username"><?php echo htmlspecialchars($row['username']); ?></span> 
                        <span class="score">
                            <span>★</span> <?php echo number_format($row['total_score']); ?>
                        </span>
                    </li>
                <?php 
                    $rank++;
                    endwhile;
                else: 
                ?>
                    <li class="leaderboard-entry" style="justify-content: center; opacity: 0.7;">
                        No players have solved challenges yet.
                    </li>
                <?php endif; ?>
            </ul>
        </section>
    </div>
  </main>

</body>
</html>
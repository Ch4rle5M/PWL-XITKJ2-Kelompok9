<?php
session_start();

$message = '';

if (isset($_SESSION['error'])) {
    $message = "<div style='color: #ff4a4a; text-align: center; margin-bottom: 15px; font-weight: bold; border: 1px solid #ff4a4a; padding: 10px; border-radius: 5px; background: rgba(255, 74, 74, 0.1);'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])) {
    $message = "<div style='color: #24c36b; text-align: center; margin-bottom: 15px; font-weight: bold; border: 1px solid #24c36b; padding: 10px; border-radius: 5px; background: rgba(36, 195, 107, 0.1);'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<head>
  <title>Ciphera Login</title>
  <link rel="stylesheet" href="../styles/login.css">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
  <style>
    .forgot-pass {
        display: block;
        text-align: right;
        color: #bb66ff;
        font-size: 0.85rem;
        margin-top: 5px;
        text-decoration: none;
    }
    .forgot-pass:hover {
        text-decoration: underline;
        color: white;
    }
  </style>
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '../components/navbar.php'; ?>
  
  <div class="container">
    <div class="container2">
      <div class="login-box">
        <h2>Login</h2>
        
        <?php echo $message; ?>

        <form action="/action/auth/login.php" method="POST">
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        
        <a href="forgorPass.php" class="forgot-pass">Forgot Password?</a>

        <button>LOGIN</button>
        </form>

        <p style="margin-top: 15px; text-align: center; color: #ccc; font-size: 0.9rem;">
            Don't have an account? <a href="signup.php" style="color: #bb66ff; text-decoration: none; font-weight: bold;">Sign Up</a>
        </p>
    </div>

    <div class="right-box">
      <h2>Cryptograph is the <br> best category</h2>
    </div>

    </div>
  </div>

</body>
</html>
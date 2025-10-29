<?php
session_start();

$error_message = '';

if (isset($_SESSION['error'])) {
    $error_message = "<p style='color: red; text-align: center;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<head>
  <title>Ciphera Login</title>
  <link rel="stylesheet" href="login.css">

  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <a href="homepage.html">
        <img src="login/Frame 6.png" alt="Ciphera Logo">
      </a>
    </div>
  <div class="menu">
    <a href="homepage.html">Home</a>
    <a href="learn.html">Learn</a>
    <a href="ctf.html">CTF</a>
    <a href="community.html">Community</a>
    <a href="signup.php">Sign In</a>
    <a href="login.php">Login</a>

  </div>
  </div>
  
  <div class="container">
    <div class="container2">
      <div class="login-box">
        <form action="/action/auth/login.php" method="POST">
          <?php echo $error_message; ?>
        <h2>Login</h2>
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username">

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password">

        <a href="forgot.html">Forgot Password</a>
        <button>LOGIN</button>
        </form>
    </div>
    <div class="right-box">
      <h2>Cryptograph is the <br> best category</h2>
    </div>
    </div>
    
  </div>

</body>
</html>

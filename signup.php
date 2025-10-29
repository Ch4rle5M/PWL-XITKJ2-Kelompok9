<?php
// Mulai session untuk membaca pesan error
session_start(); 
?>
<!DOCTYPE html>
<head>
  <title>Ciphera Sign Up</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
  
  <style>
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
      font-size: 16px;
    }
    .alert-error {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }
    .alert-success {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }
  </style>

</head>
<body>

  <div class="navbar">
    <div class="logo">
      <a href="homepage.php"> <img src="Frame 6.png" alt="Ciphera Logo">
      </a>
    </div>
    <div class="menu">
      <a href="homepage.php">Home</a> <a href="learn.php">Learn</a> <a href="ctf.php">CTF</a> <a href="community.php">Community</a> <a href="signup.php">Sign Up</a> <a href="login.php">Log In</a>
    </div>
  </div>

  
  <div class="container1">
    <div class="container3">
      <div class="left-box">
        <h2>Cryptograph is the <br> best category</h2>
      </div>

      <div class="signup-box">
        <h2>Sign Up</h2>

        <?php
        if (isset($_SESSION['error'])) {
            // Tampilkan pesan error
            echo '<div class="alert alert-error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            
            // Hapus pesan error agar tidak muncul lagi saat di-refresh
            unset($_SESSION['error']);
        }
        ?>  
        <form action="/action/auth/regis.php" method="POST">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter username" required> <label>Email</label>
          <input type="email" name="email" placeholder="Enter email" required> <label>Password</label>
          <input type="password" name="password" placeholder="Enter password" required>
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" placeholder="Confirm your password" required>
          <button type="submit">SIGN UP</button> </form>
      </div>
    </div>
  </div>

</body>
</html>
<!DOCTYPE html>
<head>
  <title>Ciphera Sign Up</title>
  <link rel="stylesheet" href="../styles/login.css">

  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <a href="homepage.php">
        <img src="../assets/Frame 6.png" alt="Ciphera Logo">
      </a>
    </div>
    <div class="menu">
      <a href="homepage.php">Home</a>
      <a href="learn.html">Learn</a>
      <a href="ctf.php">CTF</a>
      <a href="community.html">Community</a>
      <a href="signin.php">Sign In</a>
      <a href="login.php">Log In</a>
    </div>
  </div>

  
  <div class="container">

    <div class="container2">
         
    <div class="left-box">
      <h2>Cryptograph is the <br> best category</h2>
      </div>

      <div class="login-box">
        <h2>Sign Up</h2>
        <form action="../action/auth/regis.php" method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        <button>SIGN UP</button>
        </form>
      </div>

      

    </div>
    
  </div>

</body>
</html>

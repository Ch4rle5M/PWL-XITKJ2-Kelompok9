<?php
session_start();

$error_message = '';

if (isset($_SESSION['error'])) {
    $error_message = "<h2 style='color: red; text-align: center;'>" . $_SESSION['error'] . "</h2>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<head>
  <title>Ciphera Login</title>
  <link rel="stylesheet" href="../styles/login.css">

  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>
  
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

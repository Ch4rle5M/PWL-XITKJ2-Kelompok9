<!DOCTYPE html>
<html lang="id">
<head>
  <title>Forgot Password - CIPHERA</title>
  <link rel="stylesheet" href="../styles/login.css">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">
</head>
<body>

  <?php include '../components/navbar.php'; ?>
  
  <div class="container">
    <div class="container2">
      
      <div class="login-box" style="text-align: center;">
        <h2 style="color: #ff4a4a; margin-bottom: 10px;">Lupa Password?</h2>
        
        <div style="color: #ccc; line-height: 1.6; margin: 20px 0;">
            <p>Sistem email otomatis sedang dinonaktifkan.</p>
            <br>
            <p>Silakan lapor ke <strong>Administrator</strong> untuk mereset password kamu secara manual.</p>
            <br>
            <p>Password akan di-reset menjadi:</p>
            <h1 style="color: #24c36b; letter-spacing: 3px; background: #141420; display: inline-block; padding: 10px 20px; border-radius: 8px; border: 1px dashed #24c36b;">123456</h1>
        </div>

        <a href="login.php" style="text-decoration: none;">
            <button style="margin-top: 20px;">KEMBALI LOGIN</button>
        </a>
      </div>

      <div class="right-box">
        <h2>Don't worry, <br> Admin is here.</h2>
      </div>

    </div>
  </div>

</body>
</html>
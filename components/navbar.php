<link rel="stylesheet" href="/styles/navbar.css">

<div class="navbar">
    <div class="logo">
        <a href="/pages/homepage.php"> 
            <img src="/assets/homepage/nav.png" alt="Ciphera Logo">
        </a>
    </div>

    <div class="menu">
        <a href="/pages/homepage.php">Home</a>
        <a href="/pages/homepage.php#learn-section">Learn</a> 
        <a href="/pages/ctf.php">CTF</a>
        <a href="/pages/community.php">Community</a>

        <?php if (isset($_SESSION['user_id']) || (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)): ?>

            <a href="/pages/profile.php">Profile (<?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>)</a>
            <a href="/action/auth/logout.php">Logout</a>

        <?php else: ?>

            <a href="/pages/signup.php">Sign Up</a> 
            <a href="/pages/login.php">Log In</a>

        <?php endif; ?>
    </div>
</div>
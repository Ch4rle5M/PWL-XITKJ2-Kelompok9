<link rel="stylesheet" href="/styles/navbar.css">

<nav class="navbar">
    <div class="logo">
        <a href="/pages/homepage.php"> 
            <img src="/assets/homepage/nav.png" alt="Ciphera Logo">
        </a>
    </div>

    <div class="hamburger" onclick="toggleMobileMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <div class="menu" id="navMenu">
        <a href="/pages/homepage.php">Home</a>
        <a href="/pages/homepage.php#learn-section">Learn</a> 
        <a href="/pages/ctf.php">CTF</a>
        <a href="/pages/communitypage.php">Community</a>

        <?php if (isset($_SESSION['user_id']) || (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)): ?>

            <a href="/pages/profile.php">Profile</a>
            <a href="/action/auth/logout.php" class="logout-btn">Logout</a>

        <?php else: ?>

            <a href="/pages/signup.php">Sign Up</a> 
            <a href="/pages/login.php">Log In</a>

        <?php endif; ?>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('navMenu');
        const hamburger = document.querySelector('.hamburger');
        menu.classList.toggle('active');
        hamburger.classList.toggle('active');
    }
</script>
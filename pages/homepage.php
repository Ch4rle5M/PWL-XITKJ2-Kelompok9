<?php
session_start(); // <-- INI YANG HILANG. WAJIB ADA DI PALING ATAS
?>
<!DOCTYPE html>
<head>
  <title>Ciphera Homepage</title> <link rel="stylesheet" href="/styles/homepage.css">

  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@1&display=swap" rel="stylesheet">

  <style>
    html{
      scroll-behavior: smooth;
    }

  </style>

</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

  <section class="perkenalan">
    <div class="perkenalan-left">
      <img src="/assets/homepage/logo-besar.png" alt="Ciphera Icon">
    </div>
    <div class="perkenalan-text">
      <h1>CIPHERA</h1>
      <p>
        Belajar memecahkan rahasia, memahami logika di balik kode, 
        dan menguasai seni menyembunyikan pesan.<br><br>
        Website ini adalah pintu gerbang untuk siapapun yang ingin 
        menguasai kriptografi modern mulai dari dasar hingga teknik lanjut.<br><br>
        Masuk, jelajahi, dan jadilah bagian dari komunitas pecinta kode 
        yang selalu haus akan misteri.
      </p>
      <a href="#" class="btn">START NOW</a>
    </div>
  </section>

  <section class="info">
  <div class="info-top">
    <div class="info-box blue">
      <p>
        Kriptografi bukan hanya soal sandi rahasia, tapi juga kunci utama dalam menjaga keamanan digital. 
        Di sini kamu bisa mulai dari konsep dasar seperti cipher klasik, sampai ke teknik modern yang 
        dipakai dalam dunia cybersecurity.
      </p>
    </div>

    <div class="info-img">
      <img src="/assets/homepage/Group 10.png" alt="Circle Logo">
    </div>
  </div>

  <div class="info-bottom">
    
    <div class="info-img">
      <img src="/assets/homepage/Group 11.png" alt="Binary & Key">
    </div>

    
    <div class="info-box-purple">
      <p>
        Kami menyediakan pembelajaran interaktif yang menantang, dilengkapi latihan soal dan simulasi nyata. 
        Cocok untuk pemula yang baru mengenal, hingga yang ingin mengasah skill untuk kompetisi CTF atau karir profesional.
      </p>
    </div>
  </div>
</section>

  <h1 class="choose-title" id="learn-section">CHOOSE</h1>


 <div class="choose-container">

    
    <div class="choose-card" style="background: linear-gradient(145deg, #0f0, #0a0);">
      <img src="/assets/homepage/Frame 25.png" alt="Easy Icon" width="80">
      <h3>Easy</h3>
      <p>
        Learn the core Linux commands—navigation, files, permissions, and more.
        A simple start, but the foundation for everything ahead.
      </p>
            <a href="learn easy.html" class="learn-button">Learn</a>
    </div>


    <div class="choose-card" style="background: linear-gradient(145deg, #ff7b00, #b44);">
      <img src="/assets/homepage/logo 1.png" alt="Medium Icon" width="80">
      <h3>Medium</h3>
      <p>
        Master the basics of Linux commands and start exploring beginner-friendly
        Kali tools like CyberChef.
      </p>
            <a href="learn medium.html" class="learn-button">Learn</a>
    </div>

    <div class="choose-card" style="background: linear-gradient(145deg, #d00, #800);">
      <img src="/assets/homepage/python_logo_icon_214642 1.png" alt="Python" width="80">
      <h3>Hard</h3>
      <p>
        Combine advanced Kali tools with Python scripting to solve complex,
        real-world challenges.
      </p>
            <a href="hard.html" class="learn-button">Learn</a>
    </div>

  </div>

  
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-logo">
        <img src="/assets/homepage/logo-besar.png" alt="CIPHERA Logo">
        <p><strong>CIPHERA</strong></p>
      </div>
      <div class="footer-team">
        <h3>Kelompok 9</h3>
        <p> Charles Marselino
        <br>Clarance Cristiano
        <br>Fani
        </p>
      </div>
      <div class="footer-nav">
        <h3>Navbar</h3>
          <p>
            Home
            <br>Learn
            <br>CTF
            <br>Community
          </p>
      </div>
    </div>
  </footer>
</body>
</html>
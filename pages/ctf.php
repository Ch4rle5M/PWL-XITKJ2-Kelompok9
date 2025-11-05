<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CIPHERA | Challenge</title>
  <link rel="stylesheet" href="/styles/ctf.css" />
</head>
<style>
  .attach {
     display: inline-block;
     padding: 10px 15px;
     background-color: #555;
     color: white;
     text-decoration: none;
     border-radius: 5px;
     margin-top: 10px;
     }
   </style>
<body>
  <div class="navbar">
    <div class="logo">
      <a href="/pages/homepage.php">
        <img src="/assets/Frame 6.png " alt="Ciphera Logo">
      </a>
    </div>
     <div class="menu">
        <a href="/pages/homepage.php">Home</a>
        <a href="/pages/level.php">Learn</a>
        <a href="/pages/ctf.php">CTF</a>
        <a href="/pages/community.html">Community</a>
        <a href="/pages/signup.php">Sign Up</a>
        <a href="/pages/login.php">Log In</a>
        </div>
     </div>

<main>
    <h1>Challenge</h1>
    <div class="card-container">

            <div class="card" onclick="openModal(
        'Kripto kalau jadi manusia', 
        'Cryptography tuh category paling baik...', 
        '/assets/Frame 27.png', 
        '/files/chall_kripto.zip', 
        'kripto' 
      )">
        <img src="/assets/Frame 27.png" alt="Kripto kalau jadi manusia" />
        <div class="card-title">Kripto kalau jadi manusia</div>
      </div>

      <div class="card" onclick="openModal(
        'Postingan quantum', 
        'Deskripsi untuk postingan quantum...', 
        '/assets/Frame 27 (1).png', 
        '/files/quantum.txt', 
        'quantum'
      )">
        <img src="/assets/Frame 27 (1).png" alt="Postingan quantum" />
        <div class="card-title">Postingan quantum</div>
      </div>

      <div class="card" onclick="openModal(
        'Selvin RSA', 
        'Deskripsi challenge Selvin RSA.', 
        '/assets/Frame 27 (2).png', 
        '/files/selvin_rsa.py', 
        'selvin'
      )">
        <img src="/assets/Frame 27 (2).png" alt="Selvin RSA" />
        <div class="card-title">Selvin RSA</div>
      </div>

      <div class="card" onclick="openModal(
        'hoshino64', 
        'Deskripsi hoshino64...', 
        '/assets/Frame 27 (3).png', 
        null, 
        'hoshino'
      )">
        <img src="/assets/Frame 27 (3).png" alt="hoshino64" />
        <div class="card-title">hoshino64</div>
      </div>

    </div>
  </main>
    <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>

      <div class="modal-body">
                <img src="/assets/Frame 27.png" alt="" id="modal-img"> 
        <div class="modal-text">
          <h2 id="modal-title">Judul Challenge</h2>           <p><strong>Description :</strong></p>
          <p id="modal-desc">
            Deskripsi default...
          </p>

                    <a href="#" id="modal-attachment" class="attach" download>Attachment</a>

                    <form class="flag-form" id="modal-flag-form">
            <input type="text" placeholder="CTF{}" id="modal-flag-input" />
            <button type="submit">Submit</button>
          </form>   



      <script src="/scripts/script.js"></script>
</body>
</html>

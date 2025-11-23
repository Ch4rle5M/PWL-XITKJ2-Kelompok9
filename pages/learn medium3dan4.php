<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CIPHERA | Tools</title>
  <link rel="stylesheet" href="../styles/learn medium2.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>
  <main>
    <h1>Tools</h1>

    <section>
      <h2>CyberChef</h2>
      <ul>
        <li>Web tool serba bisa buat enkripsi/dekripsi.</li>
        <li>Bisa coba Caesar, Vigenère, Base64, Hex, sampai hash.</li>
        <li>URL: https://gchq.github.io/CyberChef/</li>
      </ul>
    </section>

    <section>
      <h2>dcode.fr</h2>
      <ul>
        <li>Spesialis buat classic ciphers.</li>
        <li>Ada menu Caesar, Vigenère, Substitution, Transposition, sampai Enigma.</li>
        <li>Bagus buat identifikasi jenis cipher kalau lo dikasih teks aneh.</li>
      </ul>
    </section>

    <section>
      <h2>Cryptii</h2>
      <ul>
        <li>Web tool interaktif buat lihat proses konversi teks → cipher.</li>
        <li>Cocok buat eksperimen step by step.</li>
      </ul>
    </section>

    <h1>Encrypt Classic</h1>

    <section>
      <h2>Caesar Cipher</h2>
      <ul>
        <li>Plaintext: TEKS INI SUDAH DI ENKRIP</li>
        <li>Ciphertext: WHNV LQL VXGDK GL HQNULS</li>
      </ul>
    </section>

    <section>
      <h2>Atbash Cipher</h2>
      <ul>
        <li>Plaintext: TEKS INI SUDAH DI ENKRIP</li>
        <li>Ciphertext: GVPH RMR HFWZS WR VMPIKR</li>
      </ul>
    </section>

    <section>
      <h2>Vigenère Cipher</h2>
      <ul>
        <li>Plaintext: TEKSINISUDAHDIENKRIP</li>
        <li>Key: KALIKALIKALIKALIKALI</li>
        <li>Ciphertext: DELNVQAQWWEMLRYLCXUVTZ</li>
      </ul>
    </section>

    <section>
      <h2>Rail Fence Cipher</h2>
      <ul>
        <li>Plaintext: TEKSINISUDAHDIENKRIP</li>
        <li>Ciphertext: TKIIUADINRPESNSDHEKIKISUH</li>
      </ul>
    </section>

    <div class="pagination">
      <a href="learn medium2dan3.php"><button>&lt;</button></a>
      <button class="active">3</button>
      <a href="learn medium4dan5.php"><button>4</button></a>
      <a href="learn medium4dan5.php"><button >&gt;</button></a>
    </div>
  </main>
</body>
</html>

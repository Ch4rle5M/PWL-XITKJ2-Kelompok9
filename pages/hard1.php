<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Hard 1</title>
    <link rel="stylesheet" href="../styles/hard1.css">

</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>
     <main class="content">
     <div class="slide">
    <h1>Dasar Matematika dalam Kriptografi</h1>

    <h2>Bilangan Prima & Faktorisasi</h2>
    <p>Kriptografi modern seperti RSA sangat bergantung pada bilangan prima besar.</p>
    <ul>
      <li>Faktorisasi bilangan besar menjadi sulit jika prima sangat besar.</li>
      <li>Contoh: 143 mudah dipisah jadi 11×13; 11113 menjadi 131×13, tapi angka 200 digit butuh waktu luar biasa.</li>
    </ul>

    <h2>Aritmatika Modular</h2>
    <p>Digunakan dalam hampir semua algoritma kripto.</p>
    <ul>
      <li>Operasi: <code>a ≡ b (mod n)</code></li>
      Artinya a dan b memiliki sisa yang sama saat dibagi n.
      <li>Contohnya 17≡5 (mod 12)</li>
    </ul>

    <h2>Invers Modular</h2>
    <p>Jika <code>a×x ≡ 1 (mod n)</code>, maka x disebut invers modular dari a.</p>
    <ul>
      <li>Penting dalam RSA (kunci privat dihitung dengan invers modular).</li>
    </ul>

    <h2>Fungsi Hash</h2>
    <p>Hash = fungsi satu arah, sulit dibalik.</p>
    <ul>
      <li>Contoh: SHA-256("Halo") → menghasilkan output tetap panjang 256-bit.</li>
      <li>Rumus abstrak: <code>h = H(m)</code></li>
    </ul>

    <h1>Algoritma Kriptografi Modern</h1>

    <h2>RSA (Rivest–Shamir–Adleman)</h2>
    <ul>
      Kunci Publik: (n, e)<br>
      Kunci Privat: (n, d)<br>
      Rumus: <code>C = M<sup>e</sup> mod n</code>, <code>M = C<sup>d</sup> mod n</code><br>
      dengan M = plaintext, C = ciphertext.
    </ul>

    <h2>AES (Advanced Encryption Standard)</h2>
    <ul>
      Block cipher dengan panjang blok 128-bit.<br>
      Mendukung panjang kunci 128, 192, 256-bit.<br>
      Operasi utama: SubBytes, ShiftRows, MixColumns, AddRoundKey.
    </ul>
    </div>

  <div class="pagination">
  <a href="hard2.php"><button>2</button></a>
  <a href="hard2.php"><button>></button></a>
</div>

  </main>
</body>
</html>
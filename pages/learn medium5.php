<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CIPHERA | Modern Crypto</title>
  <link rel="stylesheet" href="../styles/learn medium4.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

  <main>
    <h1>Modern Crypto</h1>

    <section>
      <h2>AES (Advance Encrypt Standart)</h2>
      <ul>
        <li>Plaintext: Teks ini sudah di enkrip</li>
        <li>Ciphertext: U2FsdGVkX1+klgk3UEK3V3Z7vLqX0DxZ7g==</li>
      </ul>
    </section>

    <section>
      <h2>RSA</h2>
      <ul>
        <li>Plaintext: Teks ini sudah di enkrip</li>
        <li>Ciphertext (disingkat): a53bdc9d84f10c45f33c9ef2b1...</li>
      </ul>
    </section>

    <p class="closing">
      Sebenarnya, metode encoding itu sangat banyak. Apa pun yang bisa melambangkan sesuatu dapat dijadikan cipher. 
      Sejarah mencatat mulai dari huruf, angka, simbol, hingga bentuk-bentuk unik pernah dipakai. 
      Karena pada dasarnya, sebuah cipher sering kali hanyalah encoding dengan aturan yang aneh dan tidak biasa. 
      Ayo ke CTF buat latihan 🔐
    </p>

    <div class="pagination">
      <a href="learn medium4dan5.php"><button>&lt;</button></a>
      <button class="active">5</button>
    </div>
  </main>
</body>
</html>

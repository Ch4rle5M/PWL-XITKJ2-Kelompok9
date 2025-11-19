<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CIPHERA | Jenis Cipher</title>
  <link rel="stylesheet" href="learn medium.css">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

  <main>
    <section class="content">
      <h2>Substitution Cipher</h2>
      <p>Huruf diganti dengan huruf lain sesuai aturan tertentu.</p>
      <ul>
        <li>Contoh paling terkenal: Caesar Cipher.</li>
        <li>Teks asli: HELLO</li>
        <li>Geser 3 → KHOOR</li>
      </ul>
      <p>Kelemahan: gampang dipecahkan dengan analisis frekuensi huruf.</p>

      <h2>Transposition Cipher</h2>
      <p>Hurufnya nggak diganti, tapi posisinya ditukar.</p>
      <ul>
        <li>Contoh: Route Cipher (pesan ditulis per baris, lalu dibaca per kolom).</li>
        <li>Teks asli: SEBUAH PESAN</li>
        <li>Ditulis 3 kolom:</li>
      </ul>

      <pre>
S E B
U A H
P E S
A N X
      </pre>
      <p>(Lalu dibaca kolom per kolom → SUPAEEBHNXS).<br>
      Kelemahan: kalau orang tahu jumlah kolom/baris, mudah dipecahkan.</p>

      <h2>Vigenère Cipher</h2>
      <p>Lebih maju dari Caesar, teknik ini pakai kata kunci untuk pergeseran huruf.</p>
      <ul>
        <li>Kata kunci: KEY</li>
        <li>Teks: HELLO</li>
        <li>Enkripsi: RIJVS</li>
      </ul>
      <p>Kelemahan: jika panjang kunci pendek, bisa dipecahkan pakai analisis Kasiski.</p>

      <h2>Playfair Cipher</h2>
      <p>Menggunakan tabel 5x5 huruf. Pesan dipecah jadi pasangan huruf, lalu tiap pasangan diubah sesuai posisi dalam tabel.</p>
      <p>Dipakai Inggris di Perang Dunia I.</p>

      <div class="pagination">
        <a href="learn medium.html"><button>&lt;</button></a>
        <a href="learn medium.html"><button>1</button></a>
        <button class="active">2</button>
        <a href="learn medium2.html"><button>3</button></a>
        <button>&gt;</button>
      </div>
    </section>
  </main>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CIPHERA | Sejarah Kriptografi</title>
  <link rel="stylesheet" href="../styles/learn medium.css">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>


  <main>
    <section class="content">
      <h2>Sejarah Kriptografi</h2>
      <p>Jadi di dalam Kriptografi terdapat teknologi yang bernama encrypt, jenis encrypt ini sangat banyak tapi mari kita mengenal sejarahnya terlebih dahulu</p>

      <h3>Awal Mula Kriptografi</h3>
      <p>Kriptografi sudah ada sejak ribuan tahun lalu. Bahkan sebelum komputer ditemukan, manusia sudah berusaha menyembunyikan pesan penting agar tidak bisa dibaca oleh musuh.</p>

      <div class="section">
        <div class="text">
          <h4>Caesar Cipher (Zaman Romawi)</h4>
          <p>Julius Caesar menggunakan teknik sederhana untuk menyembunyikan pesannya.<br>
          Caranya adalah dengan menggeser huruf dalam alfabet beberapa langkah.</p>
          <ul>
            <li>Contoh: Geser 3 huruf → A jadi D, B jadi E, dst.</li>
            <li>Kata "HELLO" jadi "KHOOR".</li>
          </ul>
          <p>Teknik ini sederhana, tapi pada masanya cukup efektif.</p>
        </div>
        <img src="/assets/caesarjpg-20210924114243 1 (3).png" alt="Julius Caesar">
      </div>

      <div class="section">
        <div class="text">
          <h4>Scytale Cipher (Yunani Kuno)</h4>
          <p>Bangsa Sparta menggunakan tongkat kayu (scytale). Pesan ditulis di kain yang digulung di tongkat. Jika lawan tidak punya tongkat dengan ukuran sama, pesan jadi acak dan tidak terbaca.</p>
        </div>
        <img src="/assets/caesarjpg-20210924114243 1.png" alt="Scytale Cipher">
      </div>

      <div class="section">
        <div class="text">
          <h4>Vigenère Cipher (Abad 16)</h4>
          <p>Lebih maju daripada Caesar, teknik ini menggunakan kata kunci untuk melakukan pergeseran huruf. Karena itu, metode ini jauh lebih sulit dipecahkan pada masanya.</p>
          <p>Contoh: Kata kunci = "KEY"<br>
          Teks = "HELLO"<br>
          Enkripsi → "RIJVS"</p>
        </div>
        <img src="/assets/caesarjpg-20210924114243 1 (1).png" alt="Vigenere Cipher">
      </div>

      <div class="section">
        <div class="text">
          <h4>Perang Dunia II – Enigma</h4>
          <p>Mesin Enigma yang dipakai Nazi Jerman adalah salah satu puncak kriptografi klasik. Mesin ini bisa menghasilkan kombinasi enkripsi yang sangat rumit. Namun, tim kriptografer dari Polandia dan Inggris (termasuk Alan Turing) berhasil memecahkannya, yang sangat membantu Sekutu memenangkan perang.</p>
        </div>
        <img src="/assets/caesarjpg-20210924114243 1 (2).png" alt="Mesin Enigma">
      </div>

      <div class="pagination">
        <button class="active">1</button>
        <a href="learn medium2dan3.php"><button>2</button></a>
        <a href="learn medium2dan3.php"><button >&gt;</button></a>
      </div>
    </section>
  </main>
</body>
</html>

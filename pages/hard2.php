<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hard 2</title>
    <link rel="stylesheet" href="../styles/hard2.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

      <main class="content">
    <div class="slide">
      <h2>Diffie–Hellman Key Exchange</h2>
      <p>Dua pihak bisa menyepakati kunci rahasia tanpa mengirimkan langsung.</p>
      <ul>
        <li>Rumus: A=g<sup>a</sup> (mod p), B=g<sup>b</sup> (mod p), K=B<sup>a</sup>=A<sup>b</sup> (mod p)</li>
      </ul>

      <h2>Elliptic Curve Cryptography (ECC)</h2>
      <ol>
        <li>Lebih ringan daripada RSA, tapi sama-sama kuat.</li>
        <li>Rumus kurva umum: y²=x³+ax+by² = x³ + a·x + by²=x³+a·x+b</li>
      </ol>

      <h1>Enkripsi dalam Python</h1>

      <h2>Kenapa Menggunakan Python untuk Kriptografi?</h2>
      <p>
        Python memiliki sintaks yang jelas dan ringkas, sehingga cocok untuk pemula maupun tingkat lanjut
        dalam mempelajari konsep kriptografi yang kompleks.
      </p>

      <h2>Dukungan Modul dan Library Lengkap</h2>
      <p>Python menyediakan berbagai library khusus kriptografi, seperti:</p>
      <ul>
        <li><b>PyCryptodome</b> → untuk RSA, AES, hashing, dll.</li>
        <li><b>Cryptography</b> → untuk implementasi algoritma modern.</li>
        <li><b>hashlib</b> → fungsi hashing standar (SHA, MD5, dll).</li>
        <li><b>base64</b> → encoding/decoding sederhana.</li>
      </ul>

      <h2>Cocok untuk Eksperimen dan Pembelajaran</h2>
      <p>
        Dengan Python, konsep matematika dan teori kripto bisa langsung diuji melalui kode singkat.
        Hal ini memudahkan transisi dari teori ke praktik.
      </p>
    </div>

     <div class="pagination">
  <a href="hard1.php"><button><</button></a>
  <a href="hard2.php"><button>2</button></a>
  <a href="hard3.php"><button>3</button></a>
  <a href="hard3.php"><button>></button></a>
</div>    

    </main> 
</body>
</html>
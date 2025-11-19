<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CIPHERA | Learn Easy</title>
  <link rel="stylesheet" href="easy.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>

    <section class="lesson">
      <div class="command">
        <span class="cmd">Ls</span>
        <span class="desc">Mencantumkan konten direktori</span>
      </div>
      <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ ls
teks.txt
      </pre>
    </section>

    <section class="lesson">
      <div class="command">
        <span class="cmd">pwd</span>
        <span class="desc">Menampilkan path direktori kerja saat ini</span>
      </div>
      <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ pwd
/home/charles/Downloads/direktori/folder/path
      </pre>
    </section>

    <section class="lesson">
      <div class="command">
        <span class="cmd">cd</span>
        <span class="desc">Mengubah direktori kerja</span>
      </div>
      <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ cd folder
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder]
$ 
      </pre>

<div class="lesson">
    <div class="command">
      <span class="cmd">ls</span>
      <span class="desc">Mencantumkan konten direktori</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ ls
teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">pwd</span>
      <span class="desc">Menampilkan path direktori kerja saat ini</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ pwd
/home/charles/Downloads/direktori/folder/path
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cd</span>
      <span class="desc">Mengubah direktori kerja</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ cd folder
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder]
$
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">rm</span>
      <span class="desc">Menghapus file</span>
    </div>
    <pre class="terminal">
$ ls
teks.txt
$ rm teks.txt
$ ls
$
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cp</span>
      <span class="desc">Menyalin file dan direktori</span>
    </div>
    <pre class="terminal">
$ cp teks.txt teks2.txt
$ ls
teks.txt  teks2.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">mv</span>
      <span class="desc">Memindahkan atau mengganti nama file</span>
    </div>
    <pre class="terminal">
$ mv teks.txt dokumen.txt
$ ls
dokumen.txt teks2.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">touch</span>
      <span class="desc">Membuat file kosong baru</span>
    </div>
    <pre class="terminal">
$ touch teksbaru.txt
$ ls
teksbaru.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">file</span>
      <span class="desc">Memeriksa jenis file</span>
    </div>
    <pre class="terminal">
$ file teks.txt
teks.txt: ASCII text
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">zip & unzip</span>
      <span class="desc">Membuat dan mengekstrak arsip ZIP</span>
    </div>
    <pre class="terminal">
$ zip arsip.zip teks.txt
adding: teks.txt (stored 0%)
$ unzip arsip.zip
Archive: arsip.zip
  inflating: teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">nano</span>
      <span class="desc">Mengedit file dengan editor teks</span>
    </div>
    <pre class="terminal">
$ nano teks.txt
# (masuk ke editor GNU Nano)
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cat</span>
      <span class="desc">Menampilkan atau menulis isi file</span>
    </div>
    <pre class="terminal">
$ cat teks.txt
ini isi dari teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">grep</span>
      <span class="desc">Mencari string di dalam file</span>
    </div>
    <pre class="terminal">
$ grep "halo" teks.txt
halo dunia
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">sudo</span>
      <span class="desc">Menjalankan perintah sebagai superuser</span>
    </div>
    <pre class="terminal">
$ sudo apt update
[sudo] password for charles:
...
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">chmod</span>
      <span class="desc">Memodifikasi izin file</span>
    </div>
    <pre class="terminal">
$ chmod +x run.sh
$ ls -l
-rwxr-xr-x run.sh
    </pre>
    <div class="lesson">
    <div class="command">
      <span class="cmd">ls</span>
      <span class="desc">Mencantumkan konten direktori</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ ls
teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">pwd</span>
      <span class="desc">Menampilkan path direktori kerja saat ini</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ pwd
/home/charles/Downloads/direktori/folder/path
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cd</span>
      <span class="desc">Mengubah direktori kerja</span>
    </div>
    <pre class="terminal">
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder/path]
$ cd folder
<span class="prompt">(charles⚙️ CharlesM)</span>[~/Downloads/direktori/folder]
$
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">rm</span>
      <span class="desc">Menghapus file</span>
    </div>
    <pre class="terminal">
$ ls
teks.txt
$ rm teks.txt
$ ls
$
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cp</span>
      <span class="desc">Menyalin file dan direktori</span>
    </div>
    <pre class="terminal">
$ cp teks.txt teks2.txt
$ ls
teks.txt  teks2.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">mv</span>
      <span class="desc">Memindahkan atau mengganti nama file</span>
    </div>
    <pre class="terminal">
$ mv teks.txt dokumen.txt
$ ls
dokumen.txt teks2.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">touch</span>
      <span class="desc">Membuat file kosong baru</span>
    </div>
    <pre class="terminal">
$ touch teksbaru.txt
$ ls
teksbaru.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">file</span>
      <span class="desc">Memeriksa jenis file</span>
    </div>
    <pre class="terminal">
$ file teks.txt
teks.txt: ASCII text
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">zip & unzip</span>
      <span class="desc">Membuat dan mengekstrak arsip ZIP</span>
    </div>
    <pre class="terminal">
$ zip arsip.zip teks.txt
adding: teks.txt (stored 0%)
$ unzip arsip.zip
Archive: arsip.zip
  inflating: teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">nano</span>
      <span class="desc">Mengedit file dengan editor teks</span>
    </div>
    <pre class="terminal">
$ nano teks.txt
# (masuk ke editor GNU Nano)
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">cat</span>
      <span class="desc">Menampilkan atau menulis isi file</span>
    </div>
    <pre class="terminal">
$ cat teks.txt
ini isi dari teks.txt
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">grep</span>
      <span class="desc">Mencari string di dalam file</span>
    </div>
    <pre class="terminal">
$ grep "halo" teks.txt
halo dunia
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">sudo</span>
      <span class="desc">Menjalankan perintah sebagai superuser</span>
    </div>
    <pre class="terminal">
$ sudo apt update
[sudo] password for charles:
...
    </pre>
  </div>

  <div class="lesson">
    <div class="command">
      <span class="cmd">chmod</span>
      <span class="desc">Memodifikasi izin file</span>
    </div>
    <pre class="terminal">
$ chmod +x run.sh
$ ls -l
-rwxr-xr-x run.sh
    </pre>
    </section>
  </main>

</body>
</html>

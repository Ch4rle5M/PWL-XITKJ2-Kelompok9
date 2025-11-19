<?php
session_start();

require_once __DIR__ . '/../db/db-con.php';

$sql = "SELECT * FROM challenges ORDER BY score ASC";
$result = $conn->query($sql);

$assetImages = [
    '/assets/Frame 27.png', 
    '/assets/Frame 27 (1).png', 
    '/assets/Frame 27 (2).png', 
    '/assets/Frame 27 (3).png'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CIPHERA | Challenge</title>
  <link rel="stylesheet" href="/styles/ctf.css" />
  <style>
    .card-title { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .card { cursor: pointer; transition: transform 0.2s; }
    .card:hover { transform: scale(1.05); }
    .attach { display: inline-block; padding: 10px 15px; background-color: #555; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; }
  </style>
</head>
<body>
  
  <?php include '../components/navbar.php'; ?>

  <main>
    <h1>Challenge List</h1>
    <div class="card-container">

      <?php if ($result && $result->num_rows > 0): ?>
        
        <?php 
          while($row = $result->fetch_assoc()): 
            $bgImage = !empty($row['image_path']) ? $row['image_path'] : '/assets/flag.jpg';
            $rawDesc = isset($row['description']) ? $row['description'] : 'Deskripsi tidak tersedia.';
            $rawCat  = isset($row['category']) ? $row['category'] : 'General';
            $jsTitle = addslashes($row['challenge_name']);
            $jsDesc  = addslashes(str_replace(["\r", "\n"], ' ', $rawDesc)); 
            $jsId    = $row['challenge_id'];
            $jsScore = isset($row['score']) ? $row['score'] : 0; 
            $jsFile = !empty($row['file_path']) ? "'" . $row['file_path'] . "'" : 'null';
        ?>

      <div class="card" onclick="openModal(
        '<?php echo $jsTitle; ?>', 
        '<?php echo $jsDesc; ?>', 
        '<?php echo $bgImage; ?>', 
        <?php echo $jsFile; ?>, 
        '<?php echo $jsId; ?>'
      )">
        <img src="<?php echo $bgImage; ?>" alt="Challenge Image" />
        <div class="card-title">
            <?php echo htmlspecialchars($row['challenge_name']); ?>
            <br>
            <span style="font-size: 0.8em; color: #fff44f;">
                ⭐ <?php echo $jsScore; ?> pts | <?php echo htmlspecialchars($rawCat); ?>
            </span>
        </div>
      </div>

      <?php endwhile; ?>
        <?php else: ?>
        <div style="width: 100%; text-align: center; padding: 50px; color: white; grid-column: 1 / -1;">
            <h2>Belum ada challenge.</h2>
            <p>Pastikan Admin sudah input soal dan Database sudah diupdate.</p>
        </div>
      <?php endif; ?> 
      </div>
  </main>

  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div class="modal-body">
        <img src="" alt="" id="modal-img" style="max-width: 100%; border-radius: 10px;"> 
        <div class="modal-text">
          <h2 id="modal-title">Judul</h2>          
          <p><strong>Description :</strong></p>
          <p id="modal-desc" style="line-height: 1.6;">Desc...</p>
          <a href="#" id="modal-attachment" class="attach" download>Download Attachment</a>
          <hr style="border-color: #444; margin: 20px 0;">
          <form class="flag-form" id="modal-flag-form">
            <label>Masukkan Flag:</label>
            <input type="text" placeholder="CTF{...}" id="modal-flag-input" required autocomplete="off"/>
            <button type="submit">Submit Flag</button>
          </form>  
        </div>
      </div>
    </div>
  </div>

  <script>
      let currentChallengeId = null;

      function openModal(title, desc, imgSrc, fileSrc, id) {
        document.getElementById('modal').style.display = "block";
        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-desc').innerHTML = desc;
        document.getElementById('modal-img').src = imgSrc;
        currentChallengeId = id;
        document.getElementById('modal-flag-input').value = '';
        
        const attachBtn = document.getElementById('modal-attachment');
        if (fileSrc && fileSrc !== null && fileSrc !== 'null') {
            attachBtn.href = fileSrc; attachBtn.style.display = 'inline-block';
        } else { attachBtn.style.display = 'none'; }
      }

      function closeModal() { document.getElementById('modal').style.display = "none"; }
      window.onclick = function(event) { if (event.target == document.getElementById('modal')) closeModal(); }

      document.getElementById('modal-flag-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const flagInput = document.getElementById('modal-flag-input').value;

        fetch('/secret/flag.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ challengeId: currentChallengeId, flag: flagInput })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'correct') {
                alert("🎉 " + data.message); closeModal(); location.reload(); 
            } else if (data.status === 'already') {
                alert("⚠️ " + data.message);
            } else {
                alert("❌ " + data.message);
            }
        })
        .catch(error => { console.error(error); alert("Server Error / Path Salah"); });
      });
  </script>
</body>
</html>
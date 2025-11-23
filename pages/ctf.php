<?php
session_start();
require_once __DIR__ . '/../db/db-con.php'; 

$sql = "SELECT * FROM challenges ORDER BY score ASC";
$result = $conn->query($sql);
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
    
    .attach { 
        display: none; 
        padding: 10px 15px; 
        background-color: #555; 
        color: white; 
        text-decoration: none; 
        border-radius: 5px; 
        margin-top: 10px; 
        font-weight: bold; 
    }
    .attach:hover { background-color: #2980b9; }
  </style>
</head>
<body>
  
  <?php include '../components/navbar.php'; ?>

  <main>
    <h1>Challenge List</h1>
    <div class="card-container">

      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): 
            
            $dbImg = $row['image_path'] ?? '';
            
            if (!empty($dbImg) && $dbImg != 'null') {
                $imgName = basename($dbImg);
                
                $finalImg = '../assets/uploads/' . $imgName;
            } else {
                $finalImg = '../assets/flag.jpg';
            }
            $rawFile = $row['file_path'] ?? $row['attachment_file'] ?? '';
            $finalLink = "";
            $filenameOnly = "";
            $isUrl = "no";

            if (!empty($rawFile) && $rawFile !== 'null') {
                if (strpos($rawFile, 'http') === 0) {
                    $finalLink = $rawFile;
                    $isUrl = "yes";
                  } else {
                    $id = $row['challenge_id']; 
                                
                    $finalLink = '../action/challenge/download.php?id=' . urlencode($id); 
                    $filenameOnly = basename($rawFile);
                }
            }

            $cat = htmlspecialchars($row['category'] ?? 'General');
            $score = $row['score'] ?? 0;
        ?>

          <div class="card" 
               onclick="openModal(this)"
               data-id="<?php echo $row['challenge_id']; ?>"
               data-title="<?php echo htmlspecialchars($row['challenge_name']); ?>"
               data-desc="<?php echo htmlspecialchars($row['description'] ?? ''); ?>"
               data-img="<?php echo htmlspecialchars($finalImg); ?>"
               
               data-link="<?php echo htmlspecialchars($finalLink); ?>"
               data-filename="<?php echo htmlspecialchars($filenameOnly); ?>"
               data-isurl="<?php echo $isUrl; ?>"
               
               data-score="<?php echo $score; ?>"
               data-cat="<?php echo $cat; ?>">
            
           
            <img src="<?php echo $finalImg; ?>" alt="Img" onerror="this.onerror=null; this.src='../assets/flag.jpg';" />
            
            <div class="card-title">
                <?php echo htmlspecialchars($row['challenge_name']); ?>
                <br>
                <span style="font-size: 0.8em; color: #fff44f;">
                    ⭐ <?php echo $score; ?> pts | <?php echo $cat; ?>
                </span>
            </div>
          </div>

        <?php endwhile; ?>
      <?php endif; ?> 
    </div>
  </main>

  <!-- MODAL -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div class="modal-body">
        <img src="" alt="" id="modal-img" style="max-width: 100%; border-radius: 10px;" onerror="this.onerror=null; this.src='../assets/flag.jpg';"> 
        <div class="modal-text">
          <h2 id="modal-title">Judul</h2>          
          <p><strong>Description :</strong></p>
          <p id="modal-desc" style="white-space: pre-line;">Desc...</p>
          
          <!-- Tombol Download -->
          <a href="#" id="modal-attachment" class="attach" download>📥 Download Attachment</a>
          
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
      const modal = document.getElementById("modal");
      const attachBtn = document.getElementById('modal-attachment');

      function openModal(element) {
        const title = element.getAttribute('data-title');
        const desc = element.getAttribute('data-desc');
        const imgSrc = element.getAttribute('data-img');
        
        // Ambil data link yang udah dirakit PHP
        const linkSrc = element.getAttribute('data-link');
        const isUrl = element.getAttribute('data-isurl');
        const filename = element.getAttribute('data-filename');
        const id = element.getAttribute('data-id');

        // Update UI
        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-desc').innerText = desc;
        document.getElementById('modal-img').src = imgSrc;
        document.getElementById('modal-flag-input').value = '';
        currentChallengeId = id;
        
        modal.style.display = "block";

        // LOGIKA TOMBOL DOWNLOAD (Simple)
        if (linkSrc && linkSrc !== "") {
            attachBtn.href = linkSrc;
            attachBtn.style.display = 'inline-block';
            
            if (isUrl === 'yes') {
                // Link Luar (Tab Baru)
                attachBtn.target = "_blank";
                attachBtn.removeAttribute('download');
            } else {
                // File Lokal (Download Langsung)
                attachBtn.target = "_self";
                // Set nama file biar pas didownload namanya bener
                if(filename) attachBtn.setAttribute('download', filename);
            }
        } else {
            attachBtn.style.display = 'none';
            attachBtn.href = '#';
        }
      }

      function closeModal() { 
        modal.style.display = "none"; 
      }

      window.onclick = function(event) { 
        if (event.target == document.getElementById('modal')) closeModal(); 
      }

      document.getElementById('modal-flag-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const flagInput = document.getElementById('modal-flag-input').value;

        fetch('../action/secret/flag.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ challengeId: currentChallengeId, flag: flagInput })
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'correct') {
                alert("🎉 " + data.message); closeModal(); location.reload(); 
            } else {
                alert((data.status === 'already' ? "⚠️ " : "❌ ") + data.message);
            }
        })
        .catch(e => alert("System Error."));
      });
  </script>
</body>
</html>
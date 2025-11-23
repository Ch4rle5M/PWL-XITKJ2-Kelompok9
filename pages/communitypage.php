<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ciphera Community</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/styles/community.css">
</head>
<body class="bg-[#05080F] text-white font-sans">
  
  <?php include $_SERVER['DOCUMENT_ROOT'] . './components/navbar.php'; ?>
  
  <div class="cards-wrapper">

    <div class="card border-green">
      <div class="card-inner bg-[#0C160D]">
        <img src="/assets/whatsapp.png" class="icon" alt="WhatsApp">
        <h2 class="title">WhatsApp</h2>
        <p class="desc">
          Join our WhatsApp group for quick updates and discussions.
        </p>
        <button class="join-btn">Join</button>
      </div>
    </div>
    
    <div class="card border-discord">
      <div class="card-inner bg-[#0C0F1A]">
        <img src="/assets/discord.png" class="icon-dc" alt="Discord">
        <h2 class="title">Discord</h2>
        <p class="desc">
          Join the community server to chat, voice call, and share code.
        </p>
        <button class="join-btn">Join</button>
      </div>
    </div>

  </div>

</body>
</html>
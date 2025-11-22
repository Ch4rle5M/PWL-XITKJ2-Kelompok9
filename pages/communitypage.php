<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ciphera Community</title>


  <script src="https://cdn.tailwindcss.com"></script>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '../components/navbar.php'; ?>

  <!-- External CSS -->
  <link rel="stylesheet" href="/styles/community.css">
</head>
<body class="bg-[#05080F] text-white font-sans">
<style>

.navbar {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 32px;
  border-bottom: 2px solid rgba(147, 51, 234, 0.4);
}

.brand {
  display: flex;
  align-items: center;
  gap: 12px;
}

.menu {
  display: flex;
  gap: 22px;
}

.navbtn {
  border: 2px solid rgba(147, 51, 234, 0.6);
  padding: 6px 18px;
  border-radius: 12px;
  font-weight: 600;
  transition: 0.25s;
}

.navbtn:hover {
  background: rgba(147, 51, 234, 0.2);
}

.cards-wrapper {
  margin-top: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 70px;
}

.card {
  width: 320px;
  height: 420px;
  border-radius: 16px;
  padding: 3px;
}

.border-green {
  background: linear-gradient(to bottom, #47ff84, #146b2f);
}

.border-discord {
  background: linear-gradient(to bottom, #6eaaff, #3a41c9);
}

.card-inner {
  width: 100%;
  height: 100%;
  border-radius: 14px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.icon {
  width: 400px;
  margin-bottom: 18px;
  opacity: 0.9;
  height: auto;
}

/* TEXT */
.title {
  font-size: 1.4rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.desc {
  font-size: 0.85rem;
  color: #cccccc;
  line-height: 1.3rem;
  margin-bottom: 36px;
}
.join-btn {
  margin-top: auto;
  width: 110px;
  padding: 8px 0;
  border-radius: 10px;
  border: 2px solid rgba(147, 51, 234, 0.7);
  font-size: 1.1rem;
  font-weight: 600;
  transition: 0.25s;
}

.join-btn:hover {
  background: rgba(147, 51, 234, 0.25);
}
.icon-dc{
  width: 200px;
  height: auto;
}

</style>
  <div class="cards-wrapper">

    <!-- WHATSAPP CARD -->
    <div class="card border-green">
      <div class="card-inner bg-[#0C160D]">
        <img src="../../assets/whatsapp.png" class="icon">
        <h2 class="title">WhatsApp</h2>
        <p class="desc">
          https://chat.whatsapp.com/<br>
          GWQ73AehVPU7AznRVu3pKs?<br>
          mode=ems_share_c
        </p>
        <button class="join-btn">Join</button>
      </div>
    </div>

    <div class="card border-discord">
      <div class="card-inner bg-[#0C0F1A]">
        <img src="../../assets/discord.png" class="icon-dc" />
        <h2 class="title">discord</h2>
        <p class="desc">
          https://discord.gg/tes
        </p>
        <button class="join-btn">Join</button>
      </div>
    </div>

  </div>

</body>
</html>

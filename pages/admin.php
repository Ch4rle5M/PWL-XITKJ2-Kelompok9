<?php
session_start();
require_once __DIR__ . '/../db/db-con.php';

if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM user WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$curr = $stmt->get_result()->fetch_assoc();

if (!$curr || $curr['role'] !== 'admin') { echo "<script>window.location.href='profile.php';</script>"; exit(); }

$listChall = $conn->query("SELECT * FROM challenges ORDER BY score ASC");
$listUsers = $conn->query("SELECT * FROM user ORDER BY id DESC");
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Admin Panel — CIPHERA</title>
  <link rel="stylesheet" href="../styles/admin.css" />
  <style>
    body { background: #07090b; color: white; font-family: sans-serif; margin: 0; }
    .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
    .admin-wrapper { display: flex; gap: 20px; margin-top: 20px; }
    .sidebar { flex: 1; display: flex; flex-direction: column; gap: 10px; }
    .main-content { flex: 3; background: #141420; padding: 30px; border-radius: 12px; border: 1px solid #7b2cff; min-height: 600px; }
    .action-btn { padding: 15px; text-align: left; background: #1e1e2f; color: white; border: 1px solid #444; cursor: pointer; font-weight: bold; transition: 0.3s; border-radius: 6px; }
    .action-btn:hover, .action-btn.active { background: #6600cc; border-color: #ff00cc; transform: translateX(5px); }
    .admin-section { display: none; animation: fadeIn 0.5s; }
    .admin-section.active { display: block; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; color: #bb66ff; margin-bottom: 8px; font-weight: bold; }
    .form-input { width: 100%; padding: 12px; background: #0b0b0f; border: 1px solid #6600cc; color: white; border-radius: 6px; box-sizing: border-box; }
    input[type="file"] { padding: 10px; background: #1e1e2f; cursor: pointer; }
    .btn-submit { background: #24c36b; color: black; font-weight: bold; padding: 12px 24px; border: none; cursor: pointer; margin-top: 10px; border-radius: 6px; width: 100%; }
    .alert { padding: 15px; margin-bottom: 20px; border-radius: 6px; font-weight: bold; }
    .success { background: rgba(36, 195, 107, 0.2); border: 1px solid #24c36b; color: #24c36b; }
    .error { background: rgba(255, 74, 74, 0.2); border: 1px solid #ff4a4a; color: #ff4a4a; }
    .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.9em; }
    .data-table th { background: #6600cc; padding: 12px; text-align: left; }
    .data-table td { border-bottom: 1px solid #444; padding: 12px; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body>

  <?php include '../components/navbar.php'; ?>

  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Admin Panel</h2>
        <span>Admin: <strong style="color:#bb66ff;"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
    </div>

    <?php if (isset($_SESSION['flash_msg'])): ?>
        <div class="alert <?php echo $_SESSION['flash_msg']['type']; ?>">
            <?php echo $_SESSION['flash_msg']['text']; ?>
        </div>
        <?php unset($_SESSION['flash_msg']); ?>
    <?php endif; ?>

    <div class="admin-wrapper">
        <div class="sidebar">
            <button class="action-btn active" onclick="openTab('add-chall', this)">➕ Buat Soal Baru</button>
            <button class="action-btn" onclick="openTab('manage-chall', this)">📂 Manage Soal</button>
            <button class="action-btn" onclick="openTab('manage-users', this)">👥 Manage Users</button>
        </div>

        <div class="main-content">
            
            <div id="add-chall" class="admin-section active">
                <h3>Create New Challenge</h3>
                
                <form method="POST" action="/action/admin/handler.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="custom_id" class="form-input" placeholder="web01, net_hard" required>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Upload Cover Image (JPG/PNG)</label>
                        <input type="file" name="image_file" class="form-input" accept="image/*">
                        <small style="color:gray">*Kalau kosong, pake gambar default.</small>
                    </div>

                    <div class="form-group">
                        <label>Kategori (Pilih atau Ketik Baru)</label>
                        <input list="cat_list" name="category" class="form-input" placeholder="Ketik kategori..." required>
                        <datalist id="cat_list">
                            <option value="Cryptography">
                        </datalist>
                    </div>

                    <div class="form-group">
                      <label>Upload Attachment Soal (ZIP/TXT/PY/PDF)</label>
                      <input type="file" name="attachment_file" class="form-input">
                      <small style="color:gray">*Opsional. K  osongkan kalau gak ada file.</small>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="desc" class="form-input" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Flag</label>
                        <input type="text" name="flag" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Score</label>
                        <input type="number" name="score" class="form-input" value="100">
                    </div>
                    <button type="submit" name="add_chall" class="btn-submit">Publish</button>
                </form>
            </div>

            <div id="manage-chall" class="admin-section">
                <h3>Daftar Soal</h3>
                <table class="data-table">
                    <thead><tr><th>ID</th><th>Judul</th><th>Img</th><th>Score</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php while($row = $listChall->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['challenge_id']); ?></td>
                            <td>
                                <?php echo htmlspecialchars($row['challenge_name']); ?><br>
                                <small style="color:gray"><?php echo $row['category']; ?></small>
                            </td>
                            <td>
                             <?php 
                               $imgShow = !empty($row['image_path']) ? $row['image_path'] : '/assets/flag.jpg'; 
                              ?>
                            <img src="<?php echo $imgShow; ?>" style="width:40px; height:40px; object-fit:cover; border-radius:4px;">
                            </td>
                            <td><?php echo $row['score']; ?></td>
                            <td>
                                <form method="POST" action="/action/admin/handler.php" onsubmit="return confirm('Hapus?');">
                                    <input type="hidden" name="del_id" value="<?php echo $row['challenge_id']; ?>">
                                    <button type="submit" name="delete_chall" style="background:red; color:white; border:none; padding:5px; cursor:pointer;">Del</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div id="manage-users" class="admin-section">
                <h3>Daftar User</h3>
                <table class="data-table">
                    <thead><tr><th>User</th><th>Role</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php while($user = $listUsers->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <form method="POST" action="/action/admin/handler.php" style="display:flex; gap:5px;">
                                    <input type="hidden" name="target_user_id" value="<?php echo $user['id']; ?>">

                                    <?php if($user['role'] !== 'admin'): ?>
                                        <button type="submit" name="action_type" value="promote" name="action_user" style="background:blue; color:white; border:none; padding:4px; cursor:pointer; border-radius:4px;">Promote</button>
                                        <button type="submit" name="action_type" value="reset_pass" name="action_user" onclick="return confirm('Reset password user ini jadi 123456?')" style="background:orange; color:black; border:none; padding:4px; cursor:pointer; border-radius:4px;">Reset Pass</button>
                                        <button type="submit" name="action_type" value="kick" name="action_user" onclick="return confirm('Kick user ini?')" style="background:red; color:white; border:none; padding:4px; cursor:pointer; border-radius:4px;">Kick</button>
                                    <?php else: ?>
                                        <button type="submit" name="action_type" value="demote" name="action_user" style="background:gray; color:white; border:none; padding:4px; cursor:pointer; border-radius:4px;">Demote</button>
                                    <?php endif; ?>
                                    <input type="hidden" name="action_user" value="1">
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
  </div>

  <script>
    function openTab(tabName, btnElement) {
        var sections = document.getElementsByClassName("admin-section");
        for (var i = 0; i < sections.length; i++) { sections[i].classList.remove("active"); }
        var btns = document.getElementsByClassName("action-btn");
        for (var i = 0; i < btns.length; i++) { btns[i].classList.remove("active"); }
        document.getElementById(tabName).classList.add("active");
        btnElement.classList.add("active");
    }
  </script>
</body>
</html>
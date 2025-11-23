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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Admin Panel — CIPHERA</title>
  <link rel="stylesheet" href="/styles/admin.css" />
</head>
<body>

  <?php include '../components/navbar.php'; ?>

  <div class="container">
    <div class="header-flex">
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
            <button class="action-btn active" onclick="openTab('add-chall', this)">➕ Buat Soal</button>
            <button class="action-btn" onclick="openTab('manage-chall', this)">📂 Manage Soal</button>
            <button class="action-btn" onclick="openTab('manage-users', this)">👥 Manage Users</button>
        </div>

        <div class="main-content">
            
            <div id="add-chall" class="admin-section active">
                <h3>Create New Challenge</h3>
                
                <form method="POST" action="/action/admin/handler.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>ID Soal (Unik)</label>
                        <input type="text" name="custom_id" class="form-input" placeholder="misal: web01, crypto_hard" required>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Cover Image</label>
                        <input type="file" name="image_file" class="form-input" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input list="cat_list" name="category" class="form-input" placeholder="Pilih / Ketik..." required>
                        <datalist id="cat_list">
                            <option value="Cryptography">
                            <option value="Web Exploitation">
                            <option value="Forensic">
                            <option value="Reverse Engineering">
                        </datalist>
                    </div>

                    <div style="background: #1e1e2f; padding: 15px; border-radius: 8px; border: 1px dashed #444; margin-bottom: 15px;">
                        <p style="margin-top:0; color:#bb66ff; font-weight:bold;">📄 File Attachment (Pilih Salah Satu)</p>
                        
                        <div class="form-group">
                          <label>Opsi 1: Upload File (Max 2MB/Sesuai Server)</label>
                          <input type="file" name="attachment_file" class="form-input">
                        </div>

                        <div style="text-align:center; margin: 5px 0; font-weight:bold; color:gray;">--- ATAU ---</div>

                        <div class="form-group">
                          <label>Opsi 2: Link Download (Gdrive, GitHub, Dropbox)</label>
                          <input type="url" name="attachment_url" class="form-input" placeholder="https://github.com/user/repo/raw/main/soal.zip">
                          <small style="color:gray">*Kalau file gede, mending taruh link-nya disini biar gak error.</small>
                        </div>
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
                    <button type="submit" name="add_chall" class="btn-submit">Publish Soal</button>
                </form>
            </div>

            <!-- TAB MANAGE SOAL -->
            <div id="manage-chall" class="admin-section">
                <h3>Daftar Soal</h3>
                <div class="table-responsive">
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
                                <img src="<?php echo $imgShow; ?>" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" onerror="this.src='/assets/flag.jpg';">
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
            </div>

            <div id="manage-users" class="admin-section">
                <h3>Daftar User</h3>
                <div class="table-responsive">
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
                                            <button type="submit" name="action_type" value="reset_pass" name="action_user" onclick="return confirm('Reset password user ini jadi 123456?')" style="background:orange; color:black; border:none; padding:4px; cursor:pointer; border-radius:4px;">Reset</button>
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
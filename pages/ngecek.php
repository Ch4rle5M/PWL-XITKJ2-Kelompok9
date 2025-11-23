<?php
require_once __DIR__ . '/../db/db-con.php';

echo "<style>body{font-family:sans-serif; background:#111; color:#eee; padding:20px;} table{border-collapse:collapse; width:100%; margin-bottom:30px;} th,td{border:1px solid #444; padding:10px; text-align:left;} th{background:#222; color:#4a6bff;} .ok{color:#0f0;} .err{color:#f00;} h2{border-bottom:2px solid #444; padding-bottom:10px;}</style>";

echo "<h1>🕵️ DETEKTIF DATABASE & FILE</h1>";

// 1. CEK STRUKTUR TABEL
echo "<h2>1. Struktur Tabel 'challenges'</h2>";
$checkTable = $conn->query("DESCRIBE challenges");
if ($checkTable) {
    echo "<table><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
    $hasFilePath = false;
    while($row = $checkTable->fetch_assoc()) {
        $color = "white";
        if ($row['Field'] == 'file_path' || $row['Field'] == 'attachment_file') {
            $color = "#0f0"; // Hijau kalau ketemu kolom file
            $hasFilePath = true;
        }
        echo "<tr>
            <td style='color:$color'>{$row['Field']}</td>
            <td>{$row['Type']}</td>
            <td>{$row['Null']}</td>
            <td>{$row['Key']}</td>
        </tr>";
    }
    echo "</table>";
    
    if (!$hasFilePath) {
        echo "<h3 class='err'>⚠️ BAHAYA: Tidak ditemukan kolom 'file_path' atau 'attachment_file'! <br>Script upload lu mungkin gagal nyimpen karena gak ada wadahnya.</h3>";
    }
} else {
    echo "<h3 class='err'>❌ Gagal baca tabel. Cek koneksi DB.</h3>";
}

// 2. CEK ISI DATA (DETIL)
echo "<h2>2. Isi Data Soal & Status File</h2>";
echo "<table><tr><th>ID</th><th>Judul</th><th>Isi Kolom File (Mentah)</th><th>Panjang</th><th>Status Fisik</th></tr>";

$sql = "SELECT * FROM challenges";
$result = $conn->query($sql);
$root = realpath(__DIR__ . '/../'); // Root project fisik

while ($row = $result->fetch_assoc()) {
    // Cek kolom mana yang ada isinya
    $rawVal = $row['file_path'] ?? $row['attachment_file'] ?? $row['attachment'] ?? null;
    
    $status = "<span style='color:gray'>-</span>";
    $len = 0;
    
    if ($rawVal) {
        $len = strlen($rawVal);
        
        // Cek Fisik (Auto Detect lokasi)
        $filename = basename($rawVal);
        $targetFile = $root . '/assets/uploads/' . $filename;
        
        if (file_exists($targetFile)) {
            $status = "<span class='ok'>✅ ADA di assets/uploads/</span>";
        } else {
            $status = "<span class='err'>❌ HILANG / SALAH NAMA</span><br><small>Dicari: $filename</small>";
        }
    } else {
        $rawVal = "<em>(NULL / Kosong)</em>";
    }

    echo "<tr>
        <td>{$row['challenge_id']}</td>
        <td>{$row['challenge_name']}</td>
        <td style='font-family:monospace; background:#222;'>$rawVal</td>
        <td>$len char</td>
        <td>$status</td>
    </tr>";
}
echo "</table>";

// 3. CEK FOLDER UPLOAD
echo "<h2>3. Cek Kesehatan Folder Upload</h2>";
$uploadPath = $root . '/assets/uploads/';
echo "Target Folder: <code>$uploadPath</code><br><br>";

if (is_dir($uploadPath)) {
    echo "Status Folder: <span class='ok'>✅ Folder Ada</span><br>";
    echo "Izin Tulis (Writable): " . (is_writable($uploadPath) ? "<span class='ok'>✅ Aman (Bisa Upload)</span>" : "<span class='err'>❌ TERKUNCI (Permission Denied)</span>") . "<br>";
    
    // List isi folder
    $files = array_diff(scandir($uploadPath), array('.', '..'));
    echo "<br><b>Isi Folder Saat Ini:</b><br>";
    if (count($files) > 0) {
        foreach($files as $f) {
            echo "📦 $f <span style='color:gray; font-size:0.8em;'>(" . filesize($uploadPath.$f) . " bytes)</span><br>";
        }
    } else {
        echo "<span class='err'>📂 Folder Kosong Melompong!</span>";
    }
} else {
    echo "<span class='err'>❌ FOLDER assets/uploads TIDAK DITEMUKAN!</span><br>Buat foldernya sekarang juga.";
}
?>
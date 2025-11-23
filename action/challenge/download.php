<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../db/db-con.php';

if (!isset($_GET['id'])) { die("ID Soal tidak ditemukan."); }

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT file_path FROM challenges WHERE challenge_id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) { die("Data soal tidak ditemukan di database."); }

$dbPath = $data['file_path'];

if (strpos($dbPath, 'http') === 0) {
    header("Location: " . $dbPath);
    exit();
}

$projectRoot = dirname(__DIR__);
$cleanDbPath = ltrim($dbPath, '/');
$cleanDbPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $cleanDbPath);
$file = $projectRoot . DIRECTORY_SEPARATOR . $cleanDbPath;

if (file_exists($file)) {

    if (ob_get_level()) { ob_end_clean(); }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    
    readfile($file);
    exit;
} else {
    echo "error";
}
?>
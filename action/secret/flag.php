<?php
header('Content-Type: application/json');

$kunciJawaban = [
    'kripto'  => 'CTF{tes}',
    'quantum' => 'CTF{quantum_memang_pusing}',
    'selvin'  => 'CTF{selvin_anak_rsa_banget}',
    'hoshino' => 'CTF{hoshino_base64_decode}'
];

$dataDariKlien = json_decode(file_get_contents('php://input'), true);

$response = [
    'status' => 'error',
    'message' => 'Data tidak lengkap.'
];

if (isset($dataDariKlien['challengeId']) && isset($dataDariKlien['flag'])) {
    
    $challengeId = $dataDariKlien['challengeId'];
    $submittedFlag = $dataDariKlien['flag'];

    if (array_key_exists($challengeId, $kunciJawaban)) {
        
        if ($kunciJawaban[$challengeId] === $submittedFlag) {
            $response['status'] = 'correct';
            $response['message'] = 'Flag Benar! Mantap Jiwa!';
        } else {
            $response['status'] = 'incorrect';
            $response['message'] = 'Flag salah. Coba lagi!';
        }
        
    } else {
        $response['message'] = 'Challenge tidak valid.';
    }
}
echo json_encode($response);

?>
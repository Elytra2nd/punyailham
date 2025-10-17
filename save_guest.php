<?php
$data_file = 'data.json';

// pastikan file data ada
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([]));
}

// baca data lama
$data = json_decode(file_get_contents($data_file), true);

// ambil data baru dari form
$nama = trim($_POST['nama'] ?? '');
$ucapan = trim($_POST['ucapan'] ?? '');

if ($nama && $ucapan) {
    $data[] = [
        'nama' => $nama,
        'ucapan' => $ucapan,
        'waktu' => date('Y-m-d H:i:s')
    ];

    // simpan ke JSON (pretty print biar rapi)
    file_put_contents($data_file, json_encode($data, JSON_PRETTY_PRINT));
}

header("Location: index.php");
exit;
?>

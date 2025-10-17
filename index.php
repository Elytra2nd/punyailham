<?php
$data_file = 'data.json';

// jika belum ada file JSON, buat file kosong
if (!file_exists($data_file)) {
    file_put_contents($data_file, json_encode([]));
}

// baca isi data
$data = json_decode(file_get_contents($data_file), true);
$data = array_reverse($data); // urut dari terbaru
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Undangan (JSON)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center mb-4">📖 Buku Tamu Undangan</h2>

    <form action="save_guest.php" method="POST" class="card p-4 shadow-sm mb-5">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ucapan</label>
            <textarea name="ucapan" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Kirim</button>
    </form>

    <h4 class="mb-3">Daftar Tamu</h4>
    <?php if (count($data) === 0): ?>
        <p class="text-muted">Belum ada tamu.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($data as $tamu): ?>
                <div class="list-group-item">
                    <strong><?= htmlspecialchars($tamu['nama']) ?></strong>
                    <small class="text-muted float-end"><?= $tamu['waktu'] ?></small>
                    <p class="mb-0"><?= nl2br(htmlspecialchars($tamu['ucapan'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <style>
        .error { color: #b00020; font-size: 0.9em; }
    </style>
</head>
<body>

    <h1>Tambah Mahasiswa</h1>

    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <form method="POST" action="<?= BASE_URL ?>/mahasiswa/store">

        <label>NIM</label><br>
        <input type="text" name="nim"
               value="<?= htmlspecialchars($old['nim'] ?? '') ?>">
        <?php if (isset($errors['nim'])): ?>
            <div class="error"><?= htmlspecialchars($errors['nim']) ?></div>
        <?php endif; ?>

        <br><br>

        <label>Nama Mahasiswa</label><br>
        <input type="text" name="nama"
               value="<?= htmlspecialchars($old['nama'] ?? '') ?>">
        <?php if (isset($errors['nama'])): ?>
            <div class="error"><?= htmlspecialchars($errors['nama']) ?></div>
        <?php endif; ?>

        <br><br>

        <label>Prodi</label><br>
        <select name="prodi">
            <option value="">-- Pilih Prodi --</option>
            <?php foreach ($prodiList as $namaProdi): ?>
                <option value="<?= htmlspecialchars($namaProdi) ?>"
                    <?= ($old['prodi'] ?? '') === $namaProdi ? 'selected' : '' ?>>
                    <?= htmlspecialchars($namaProdi) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['prodi'])): ?>
            <div class="error"><?= htmlspecialchars($errors['prodi']) ?></div>
        <?php endif; ?>

        <br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="">-- Pilih Status --</option>
            <?php foreach (['Aktif', 'Lulus', 'Cuti'] as $opt): ?>
                <option value="<?= $opt ?>"
                    <?= strcasecmp($old['status'] ?? '', $opt) === 0 ? 'selected' : '' ?>>
                    <?= $opt ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['status'])): ?>
            <div class="error"><?= htmlspecialchars($errors['status']) ?></div>
        <?php endif; ?>

        <br><br>

        <button type="submit">Simpan</button>

        <a href="<?= BASE_URL ?>/mahasiswa">
            Batal
        </a>

    </form>

</body>
</html>

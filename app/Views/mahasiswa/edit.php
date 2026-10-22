<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <style>
        .error { color: #b00020; font-size: 0.9em; }
    </style>
</head>
<body>

    <h1>Edit Mahasiswa</h1>

    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <form method="POST" action="<?= BASE_URL ?>/mahasiswa/update">

        <input type="hidden"
               name="id"
               value="<?= (int) $mahasiswa['id'] ?>">

        <label>NIM</label><br>
        <input type="text"
               name="nim"
               value="<?= htmlspecialchars($mahasiswa['nim']) ?>">
        <?php if (isset($errors['nim'])): ?>
            <div class="error"><?= htmlspecialchars($errors['nim']) ?></div>
        <?php endif; ?>

        <br><br>

        <label>Nama Mahasiswa</label><br>
        <input type="text"
               name="nama"
               value="<?= htmlspecialchars($mahasiswa['nama']) ?>">
        <?php if (isset($errors['nama'])): ?>
            <div class="error"><?= htmlspecialchars($errors['nama']) ?></div>
        <?php endif; ?>

        <br><br>

        <label>Prodi</label><br>
        <select name="prodi">
            <option value="">-- Pilih Prodi --</option>
            <?php foreach ($prodiList as $namaProdi): ?>
                <option value="<?= htmlspecialchars($namaProdi) ?>"
                    <?= $mahasiswa['prodi'] === $namaProdi ? 'selected' : '' ?>>
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
            <?php foreach (['Aktif', 'Lulus', 'Cuti'] as $opt): ?>
                <option value="<?= $opt ?>"
                    <?= strcasecmp($mahasiswa['status'], $opt) === 0 ? 'selected' : '' ?>>
                    <?= $opt ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['status'])): ?>
            <div class="error"><?= htmlspecialchars($errors['status']) ?></div>
        <?php endif; ?>

        <br><br>

        <button type="submit">Simpan Perubahan</button>

        <a href="<?= BASE_URL ?>/mahasiswa">
            Batal
        </a>

    </form>

</body>
</html>

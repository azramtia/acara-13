<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>

    <h1>Data Mahasiswa</h1>

    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <p>
        <a href="<?= BASE_URL ?>/mahasiswa/create">
            + Tambah Mahasiswa
        </a>
        |
        <a href="<?= BASE_URL ?>/dashboard">Dashboard</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($mahasiswa as $mhs): ?>

            <tr>
                <td><?= htmlspecialchars($mhs['id']) ?></td>
                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                <td><?= htmlspecialchars($mhs['status']) ?></td>

                <td>
                    <a href="<?= BASE_URL ?>/mahasiswa/edit?id=<?= (int) $mhs['id'] ?>">
                        Edit
                    </a>

                    <form method="POST"
                          action="<?= BASE_URL ?>/mahasiswa/delete"
                          style="display:inline;">

                        <input type="hidden"
                               name="id"
                               value="<?= (int) $mhs['id'] ?>">

                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                            Hapus
                        </button>

                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>

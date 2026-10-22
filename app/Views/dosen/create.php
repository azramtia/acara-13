<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen' ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-sm">

            <div class="card-body">

                <h2 class="mb-4">
                    <?= isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen' ?>
                </h2>

                <form
                    action="<?= isset($dosen)
                        ? BASE_URL . '/dosen/update'
                        : BASE_URL . '/dosen/store' ?>"
                    method="POST">

                    <?php if (isset($dosen)): ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= htmlspecialchars($dosen['id']) ?>">

                    <?php endif; ?>

                    <div class="mb-3">

                        <label class="form-label">
                            NIDN
                        </label>

                        <input
                            type="text"
                            name="nidn"
                            class="form-control"
                            value="<?= isset($dosen)
                                ? htmlspecialchars($dosen['nidn'])
                                : '' ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Dosen
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= isset($dosen)
                                ? htmlspecialchars($dosen['nama'])
                                : '' ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Bidang Keahlian
                        </label>

                        <input
                            type="text"
                            name="bidang_keahlian"
                            class="form-control"
                            value="<?= isset($dosen)
                                ? htmlspecialchars($dosen['bidang_keahlian'])
                                : '' ?>"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <?= isset($dosen)
                            ? 'Simpan Perubahan'
                            : 'Simpan' ?>

                    </button>

                    <a
                        href="<?= BASE_URL ?>/dosen"
                        class="btn btn-secondary">
                        Batal
                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
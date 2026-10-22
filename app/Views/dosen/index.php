<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Dosen</title>

    <!-- Bootstrap-->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="mb-0">
                        Data Dosen
                    </h2>

                    <a
                        href="<?= BASE_URL ?>/dosen/create"
                        class="btn btn-primary">
                        + Tambah Dosen
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-primary">

                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Bidang Keahlian</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($dosen as $index => $item): ?>

                                <tr>

                                    <td>
                                        <?= $index + 1 ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($item['nidn']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($item['nama']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($item['bidang_keahlian']) ?>
                                    </td>

                                    <td>

                                        <a
                                            href="<?= BASE_URL ?>/dosen/edit?id=<?= $item['id'] ?>"
                                            class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <a
                                            href="<?= BASE_URL ?>/dosen/delete?id=<?= $item['id'] ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data ini?')">
                                            Hapus
                                        </a>

                                        

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>


                <a
                    href="<?= BASE_URL ?>/dashboard"
                    class="btn btn-secondary">
                    Kembali ke Dashboard
                </a>

            </div>

        </div>

    </div>

</body>

</html>
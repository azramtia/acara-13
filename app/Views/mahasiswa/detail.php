<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail Mahasiswa</title>

    <!-- Bootstrap 5 CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-sm">

            <div class="card-body">

                <h2 class="mb-4">
                    Detail Mahasiswa
                </h2>

                <table class="table table-bordered">

                    <tr>
                        <th width="200">NIM</th>
                        <td>
                            <?= htmlspecialchars($mahasiswa['nim']) ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td>
                            <?= htmlspecialchars($mahasiswa['nama']) ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td>
                            <?= htmlspecialchars($mahasiswa['prodi']) ?>
                        </td>
                    </tr>

                </table>

                <a
                    href="<?= BASE_URL ?>/mahasiswa"
                    class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</body>

</html>
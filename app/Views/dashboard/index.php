<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard - Sistem Informasi Akademik</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">

        <div class="container">

            <a
                href="<?= BASE_URL ?>/dashboard"
                class="navbar-brand">
                Sistem Informasi Akademik
            </a>

            <a
                href="<?= BASE_URL ?>/logout"
                class="btn btn-light btn-sm">
                Logout
            </a>

        </div>

    </nav>


    <div class="container mt-5">

        <h2>Dashboard</h2>

        <p class="text-muted">
            Selamat datang,
            <strong><?= htmlspecialchars($_SESSION['user'] ?? 'Admin'); ?></strong>.
        </p>


        <div class="row mt-4">

            <div class="col-md-6 mb-3">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h5 class="card-title">
                            Data Mahasiswa
                        </h5>

                        <p class="card-text">
                            Melihat data mahasiswa.
                        </p>

                        <a
                            href="<?= BASE_URL ?>/mahasiswa"
                            class="btn btn-primary">
                            Data Mahasiswa
                        </a>

                    </div>

                </div>

            </div>


            <div class="col-md-6 mb-3">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h5 class="card-title">
                            Data Dosen
                        </h5>

                        <p class="card-text">
                            Melihat data dosen.
                        </p>

                        <a
                            href="<?= BASE_URL ?>/dosen"
                            class="btn btn-primary">
                            Data Dosen
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
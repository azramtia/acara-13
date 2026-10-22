<?php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/Dosen.php';

class DosenController
{
    public function index()
    {
        $pdo = (new Database())->getConnection();

        $model = new Dosen($pdo);
        $dosen = $model->getAll();

        require_once __DIR__ . '/../Views/dosen/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/dosen/create.php';
    }

    public function store()
    {
        $pdo = (new Database())->getConnection();

        $model = new Dosen($pdo);

        $model->create([
            'nidn' => $_POST['nidn'],
            'nama' => $_POST['nama'],
            'bidang_keahlian' => $_POST['bidang_keahlian']
        ]);

        header('Location: ' . BASE_URL . '/dosen');
        exit;
    }

    public function edit($id)
    {
        $pdo = (new Database())->getConnection();

        $model = new Dosen($pdo);

        $dosen = $model->getById($id);

        require_once __DIR__ . '/../Views/dosen/create.php';
    }

    public function update($id)
    {
        $pdo = (new Database())->getConnection();

        $model = new Dosen($pdo);

        $model->update($id, [
            'nidn' => $_POST['nidn'],
            'nama' => $_POST['nama'],
            'bidang_keahlian' => $_POST['bidang_keahlian']
        ]);

        header('Location: ' . BASE_URL . '/dosen');
        exit;
    }

    public function delete($id)
    {
        $pdo = (new Database())->getConnection();

        $model = new Dosen($pdo);

        $model->delete($id);

        header('Location: ' . BASE_URL . '/dosen');
        exit;
    }
}
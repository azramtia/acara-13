<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../Core/Flash.php';
require_once __DIR__ . '/../Models/MahasiswaRepository.php';
require_once __DIR__ . '/../Models/ProdiRepository.php';
require_once __DIR__ . '/../Services/MahasiswaService.php';

class MahasiswaController extends BaseController
{
    private const LIST_URL = BASE_URL . '/mahasiswa';

    private MahasiswaService $service;

    public function __construct()
    {
        $database = new Database();

        $this->service = new MahasiswaService(
            new MahasiswaRepository($database),
            new ProdiRepository($database)
        );
    }

    public function index()
    {
        AuthMiddleware::handle();

        $this->view('mahasiswa/index', [
            'mahasiswa' => $this->service->all(),
            'flash'     => Flash::pull(),
        ]);
    }

    public function detail()
    {
        AuthMiddleware::handle();

        $mahasiswa = $this->service->findDetail((int) ($_GET['id'] ?? 0));

        if (!$mahasiswa) {
            Flash::error('Data mahasiswa tidak ditemukan');
            $this->redirect(self::LIST_URL);
        }

        $this->view('mahasiswa/detail', ['mahasiswa' => $mahasiswa]);
    }

    public function create()
    {
        AuthMiddleware::handle();

        $this->view('mahasiswa/create', [
            'prodiList' => $this->service->prodiOptions(),
            'flash'     => Flash::pull(),
            'errors'    => Flash::pullErrors(),
            'old'       => Flash::pullOld(),
        ]);
    }

    public function store()
    {
        AuthMiddleware::handle();
        $this->mustBePost();

        $result = $this->service->create($_POST);

        $this->respond($result, $_POST, BASE_URL . '/mahasiswa/create');
    }

    public function edit()
    {
        AuthMiddleware::handle();

        $mahasiswa = $this->service->find((int) ($_GET['id'] ?? 0));

        if (!$mahasiswa) {
            Flash::error('Data mahasiswa tidak ditemukan');
            $this->redirect(self::LIST_URL);
        }

        // Jika sebelumnya validasi gagal, tampilkan kembali isian terakhir
        $old = Flash::pullOld();
        unset($old['id']);

        $this->view('mahasiswa/edit', [
            'mahasiswa' => array_merge($mahasiswa, $old),
            'prodiList' => $this->service->prodiOptions(),
            'flash'     => Flash::pull(),
            'errors'    => Flash::pullErrors(),
        ]);
    }

    public function update()
    {
        AuthMiddleware::handle();
        $this->mustBePost();

        $id = (int) ($_POST['id'] ?? 0);

        $result = $this->service->update($id, $_POST);

        $this->respond($result, $_POST, BASE_URL . '/mahasiswa/edit?id=' . $id);
    }

    public function delete()
    {
        AuthMiddleware::handle();
        $this->mustBePost();

        $result = $this->service->delete((int) ($_POST['id'] ?? 0));

        if ($result['success']) {
            Flash::success($result['message']);
        } else {
            Flash::error($result['errors']['_global'] ?? 'Data gagal dihapus');
        }

        $this->redirect(self::LIST_URL);
    }

    private function respond(array $result, array $input, string $formUrl): void
    {
        if ($result['success']) {
            Flash::success($result['message']);
            $this->redirect(self::LIST_URL);
        }

        $errors = $result['errors'];

        if (($errors['nim'] ?? '') === 'NIM sudah terdaftar') {
            Flash::error('NIM sudah terdaftar');
        } else {
            Flash::error($errors['_global'] ?? 'Data gagal disimpan, periksa kembali isian Anda');
        }

        Flash::withForm($errors, $input);

        $this->redirect($formUrl);
    }

    // Aksi yang mengubah data hanya boleh lewat form (POST)
    private function mustBePost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(self::LIST_URL);
        }
    }
}

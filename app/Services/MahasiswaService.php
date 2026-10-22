<?php

require_once __DIR__ . '/../Models/MahasiswaRepository.php';
require_once __DIR__ . '/../Models/ProdiRepository.php';

class MahasiswaService
{
    private const STATUS_VALID = ['aktif', 'lulus', 'cuti'];

    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {}

    public function all(): array
    {
        return $this->repo->all();
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function findDetail(int $id)
    {
        return $this->repo->findDetail($id);
    }

    public function prodiOptions(): array
    {
        return $this->prodiRepo->names();
    }

    public function create(array $input): array
    {
        $input  = $this->normalize($input);
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return $this->fail($errors);
        }

        try {
            $id = $this->repo->create($input);
        } catch (PDOException $e) {
            return $this->fail($this->databaseErrors($e));
        }

        return [
            'success' => true,
            'id'      => $id,
            'message' => 'Data mahasiswa berhasil ditambahkan',
        ];
    }


    public function update(int $id, array $input): array
    {
        if ($id <= 0 || !$this->repo->find($id)) {
            return $this->fail(['_global' => 'Data mahasiswa tidak ditemukan']);
        }

        $input  = $this->normalize($input);
        $errors = $this->validate($input, $id);

        if (!empty($errors)) {
            return $this->fail($errors);
        }

        try {
            $this->repo->update($id, $input);
        } catch (PDOException $e) {
            return $this->fail($this->databaseErrors($e));
        }

        return [
            'success' => true,
            'id'      => $id,
            'message' => 'Data mahasiswa berhasil diubah',
        ];
    }

    public function delete(int $id): array
    {
        if ($id <= 0 || !$this->repo->find($id)) {
            return $this->fail(['_global' => 'Data mahasiswa tidak ditemukan']);
        }

        try {
            $this->repo->delete($id);
        } catch (PDOException $e) {
            return [
                'success' => false,
                'errors'  => ['_global' => 'Data gagal dihapus'],
            ];
        }

        return [
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus',
        ];
    }

    private function validate(array $input, ?int $exceptId = null): array
    {
        $errors = [];

        // NIM
        if ($input['nim'] === '') {
    $errors['nim'] = 'NIM wajib diisi';
        } elseif (!preg_match('/^[0-9]+$/', $input['nim'])) {
    $errors['nim'] = 'NIM harus berupa angka';
        } elseif (strlen($input['nim']) > 20) {
            $errors['nim'] = 'NIM maksimal 20 karakter';
        } elseif ($this->repo->existsByNim($input['nim'], $exceptId)) {
            $errors['nim'] = 'NIM sudah terdaftar';
        }

        // Nama
        if ($input['nama'] === '') {
            $errors['nama'] = 'Nama wajib diisi';
        } elseif (strlen($input['nama']) > 100) {
            $errors['nama'] = 'Nama maksimal 100 karakter';
        }

        // Prodi
        if ($input['prodi'] === '') {
            $errors['prodi'] = 'Program studi wajib dipilih';
        } elseif (!$this->prodiRepo->existsByNama($input['prodi'])) {
            $errors['prodi'] = 'Program studi tidak tersedia';
        }

        // Status
        if ($input['status'] === '') {
            $errors['status'] = 'Status wajib dipilih';
        } elseif (!in_array(strtolower($input['status']), self::STATUS_VALID, true)) {
            $errors['status'] = 'Status tidak valid';
        }

        return $errors;
    }

    // Bersihkan spasi dan pastikan semua key ada (tidak ada undefined index)
    private function normalize(array $input): array
    {
        return [
            'nim'    => trim((string) ($input['nim'] ?? '')),
            'nama'   => trim((string) ($input['nama'] ?? '')),
            'prodi'  => trim((string) ($input['prodi'] ?? '')),
            'status' => trim((string) ($input['status'] ?? '')),
        ];
    }

    // Terjemahkan error database menjadi pesan untuk pengguna
    private function databaseErrors(PDOException $e): array
    {
   
        if ($e->getCode() === '23000') {
            return ['nim' => 'NIM sudah terdaftar'];
        }

        return ['_global' => 'Data gagal disimpan'];
    }

    private function fail(array $errors): array
    {
        return [
            'success' => false,
            'errors'  => $errors,
        ];
    }
}

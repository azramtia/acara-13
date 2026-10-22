<?php

/**
 * Mahasiswa (entity)
 * Menampung data satu mahasiswa lewat getter & setter.
 * Query ke database ada di MahasiswaRepository.
 */
class Mahasiswa
{
    private $id;
    private $nim;
    private $nama;
    private $prodi;
    private $status;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = (int) $id; }

    public function getNim() { return $this->nim; }
    public function setNim($nim) { $this->nim = trim($nim); }

    public function getNama() { return $this->nama; }
    public function setNama($nama) { $this->nama = trim($nama); }

    public function getProdi() { return $this->prodi; }
    public function setProdi($prodi) { $this->prodi = trim($prodi); }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = strtolower(trim($status)); }
}

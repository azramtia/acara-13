<?php

require_once __DIR__ . '/Model.php';

/**
 * ProdiRepository
 * Akses tabel prodi. Dipakai MahasiswaService untuk memastikan
 * program studi yang dipilih memang tersedia.
 */
class ProdiRepository extends Model
{
    // Daftar nama prodi (untuk dropdown form)
    public function names(): array
    {
        $stmt = $this->db->query("SELECT nama FROM prodi ORDER BY nama");

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function existsByNama(string $nama): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM prodi WHERE nama = :nama");
        $stmt->execute([':nama' => $nama]);

        return (int) $stmt->fetchColumn() > 0;
    }
}

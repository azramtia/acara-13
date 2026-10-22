<?php

require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/Mahasiswa.php';

class MahasiswaRepository extends Model
{

    public function all()
    {
        $sql = "SELECT id, nim, nama, prodi, status
                FROM mahasiswa
                ORDER BY nim";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM mahasiswa WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findDetail($id)
    {
        $sql = "SELECT nim, nama, prodi
                FROM mahasiswa
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existsByNim($nim, $exceptId = null)
    {
        $sql = "SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim";
        $params = [':nim' => $nim];

        if ($exceptId !== null) {
            $sql .= " AND id <> :id";
            $params[':id'] = $exceptId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function create($data)
    {
        $mahasiswa = new Mahasiswa();

        $mahasiswa->setNim($data['nim']);
        $mahasiswa->setNama($data['nama']);
        $mahasiswa->setProdi($data['prodi']);
        $mahasiswa->setStatus($data['status']);

        $sql = "INSERT INTO mahasiswa
                (nim, nama, prodi, status)
                VALUES
                (:nim, :nama, :prodi, :status)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nim' => $mahasiswa->getNim(),
            ':nama' => $mahasiswa->getNama(),
            ':prodi' => $mahasiswa->getProdi(),
            ':status' => $mahasiswa->getStatus()
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $mahasiswa = new Mahasiswa();

        $mahasiswa->setId($id);
        $mahasiswa->setNim($data['nim']);
        $mahasiswa->setNama($data['nama']);
        $mahasiswa->setProdi($data['prodi']);
        $mahasiswa->setStatus($data['status']);

        $sql = "UPDATE mahasiswa SET
                    nim = :nim,
                    nama = :nama,
                    prodi = :prodi,
                    status = :status
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $mahasiswa->getId(),
            ':nim' => $mahasiswa->getNim(),
            ':nama' => $mahasiswa->getNama(),
            ':prodi' => $mahasiswa->getProdi(),
            ':status' => $mahasiswa->getStatus()
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM mahasiswa WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}

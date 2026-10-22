<?php

class Dosen
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query(
            "SELECT * FROM dosen ORDER BY nama ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM dosen WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO dosen
            (nidn, nama, bidang_keahlian)
            VALUES (:nidn, :nama, :bidang_keahlian)"
        );

        return $stmt->execute([
            'nidn' => $data['nidn'],
            'nama' => $data['nama'],
            'bidang_keahlian' => $data['bidang_keahlian']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE dosen
            SET nidn = :nidn,
                nama = :nama,
                bidang_keahlian = :bidang_keahlian
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'nidn' => $data['nidn'],
            'nama' => $data['nama'],
            'bidang_keahlian' => $data['bidang_keahlian']
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM dosen WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}
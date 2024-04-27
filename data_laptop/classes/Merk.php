<?php

class Merk extends DB
{
    function getMerk()
    {
        $query = "SELECT * FROM merk";
        return $this->execute($query);
    }

    function getMerkById($id)
    {
        $query = "SELECT * FROM merk WHERE merk_id=$id";
        return $this->execute($query);
    }

    function addMerk($data)
    {
        $merk_nama = $data['merk_nama'];
        $query = "INSERT INTO merk VALUES('', '$merk_nama')";
        return $this->executeAffected($query);
    }

    function updateMerk($id, $data)
    {
        $merk_nama = $data['merk_nama'];
        $query = "UPDATE merk SET merk_nama = '$merk_nama' WHERE merk_id = $id";
        return $this->executeAffected($query);
    }

    function deleteMerk($id)
    {
        $query = "DELETE FROM merk WHERE merk_id = $id";
        return $this->executeAffected($query);
    }
}

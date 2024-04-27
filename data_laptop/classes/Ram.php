<?php

class Ram extends DB
{
    function getRam()
    {
        $query = "SELECT * FROM ram";
        return $this->execute($query);
    }

    function getRamById($id)
    {
        $query = "SELECT * FROM ram WHERE ram_id=$id";
        return $this->execute($query);
    }

    function addRam($data)
    {
        $ram_ukuran = $data['ram_ukuran'];
        $query = "INSERT INTO ram VALUES('', '$ram_ukuran')";
        return $this->executeAffected($query);
    }

    function updateRam($id, $data)
    {
        $ram_ukuran = $data['ram_ukuran'];
        $query = "UPDATE ram SET ram_ukuran = '$ram_ukuran' WHERE ram_id = $id";
        return $this->executeAffected($query);
    }

    function deleteRam($id)
    {
        $query = "DELETE FROM ram WHERE ram_id = $id";
        return $this->executeAffected($query);
    }
}

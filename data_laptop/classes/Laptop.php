<?php

class Laptop extends DB
{
    function getLaptopJoin()
    {
        $query = "SELECT * FROM laptop JOIN merk ON laptop.merk_id = merk.merk_id JOIN ram ON laptop.ram_id = ram.ram_id ORDER BY laptop.laptop_id";

        return $this->execute($query);
    }

    function getLaptop()
    {
        $query = "SELECT * FROM laptop";
        return $this->execute($query);
    }

    function getLaptopById($id)
    {
        $query = "SELECT * FROM laptop JOIN merk ON laptop.merk_id = merk.merk_id JOIN ram ON laptop.ram_id = ram.ram_id WHERE laptop_id=$id";
        return $this->execute($query);
    }

    function searchLaptop($keyword)
    {
        $query = "SELECT * FROM laptop 
             JOIN merk ON laptop.merk_id = merk.merk_id
             JOIN ram ON laptop.ram_id = ram.ram_id
             WHERE laptop_nama LIKE '%$keyword%'
                OR merk.merk_nama LIKE '%$keyword%'
                OR ram.ram_ukuran LIKE '%$keyword%'
                OR laptop.sistem_operasi LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addLaptop($data, $file)
    {
        // Ambil nilai dari data
        $laptop_nama = $data['laptop_nama'];
        $merk_id = $data['merk_id'];
        $ram_id = $data['ram_id'];
        $kapasitas = $data['kapasitas'];
        $sistem_operasi = $data['sistem_operasi'];
        
        // Ambil ekstensi file
        $fileExtension = '';
        if (!empty($file['name'])) {
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        }
        // Nama file unik
        $fotoName = $file['name'];
        
        // Lokasi penyimpanan file foto
        $targetDir = 'assets/images/';
        $targetFile = $targetDir . $fotoName;
        
        // Pindahkan file foto ke direktori yang ditentukan
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Query untuk menambahkan data laptop ke database
            $query = "INSERT INTO laptop (laptop_nama, merk_id, ram_id, kapasitas, sistem_operasi, laptop_foto) VALUES ('$laptop_nama', $merk_id, $ram_id, '$kapasitas', '$sistem_operasi', '$fotoName')";
            // Eksekusi query
            return $this->executeAffected($query);
        } 
        else {
            // Jika gagal menyimpan file foto, kembalikan nilai 0
            return 0;
        }
    }

    function updateLaptop($id, $data, $file)
    {
        // Ambil nilai dari data
        $laptop_nama = $data['laptop_nama'];
        $merk_id = $data['merk_id'];
        $ram_id = $data['ram_id'];
        $kapasitas = $data['kapasitas'];
        $sistem_operasi = $data['sistem_operasi'];

        if (!empty($file['name'])) {
            
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
            $fotoName = $file['name'];
        
            $targetDir = 'assets/images/';
            $targetFile = $targetDir . $fotoName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $fotoQuery = ", laptop_foto='$fotoName'";
            } else {
                $fotoQuery = "";
            }
        } else {
            $fotoQuery = "";
        }
    
        // Query to update laptop data
        $query = "UPDATE laptop
                    SET laptop_nama='$laptop_nama', merk_id=$merk_id, ram_id=$ram_id, kapasitas='$kapasitas', sistem_operasi='$sistem_operasi' $fotoQuery
                    WHERE laptop_id=$id";
    
        // Execute the query
        return $this->executeAffected($query);
    }

    function deleteLaptop($id)
    {
        $query = "DELETE FROM laptop WHERE laptop_id = $id";
        return $this->executeAffected($query);
    }
}

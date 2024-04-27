<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Ram.php');
include('classes/Laptop.php');
include('classes/Template.php');

// buat instance Laptop
$listLaptop = new Laptop($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$merk->open();
$merk->getMerk();

$ram = new Ram($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ram->open();
$ram->getRam();

// buka koneksi
$listLaptop->open();
// tampilkan data Laptop
$listLaptop->getLaptopJoin();

$data = null;

if(isset($_POST['btn-simpan'])){
    $data = [
        'fileNameFoto' => $_FILES['fotoToUpload']['name'],
        'laptop_nama' => $_POST['laptop_nama'],
        'kapasitas' => $_POST['kapasitas'],
        'sistem_operasi' => $_POST['sistem_operasi'],
        'merk_id' => $_POST['merk_id'],
        'ram_id' => $_POST['ram_id'],
    ];

    $file = $_FILES['fotoToUpload'];

    $result = $listLaptop->addLaptop($data, $file);
    
    if($result > 0){
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo '<script>alert("Data gagal ditambahkan!");</script>';
    }
}

$merkData = null;
$ramData = null;

// untuk list merk
while ($me = $merk->getResult()) {
    $merkData .= '<option value="' . $me['merk_id'] . '">' . $me['merk_nama'] . '</option>'; 
}

// untuk list ram
while ($ra = $ram->getResult()) {
    $ramData .= '<option value="' . $ra['ram_id'] . '">' . $ra['ram_ukuran'] . '</option>'; 
}

$judul = 'Tambah';

// buat instance template
$view = new Template('templates/skinform.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_MERK', $merkData);
$view->replace('DATA_RAM', $ramData);
$view->replace('DATA_BUTTON', "Tambah");

$view->write();
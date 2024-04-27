<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Ram.php');
include('classes/Laptop.php');
include('classes/Template.php');

$id = $_GET['id'];
$laptop = new Laptop($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$laptop->open();
$laptop->getLaptopById($id);
$row = $laptop->getResult();
$data_nama = $row['laptop_nama'];
$data_foto = $row['laptop_foto'];
$kapasitas = $row['kapasitas'];
$sistem_operasi = $row['sistem_operasi'];
$merk_terpilih = $row['merk_id'];
$ram_terpilih = $row['ram_id'];

$merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$merk->open();
$merk->getMerk();

$ram = new Ram($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ram->open();
$ram->getRam();

$data = null;

if (isset($_POST['btn-simpan'])) {
    $data = [
        'fileNameFoto' => $_FILES['fotoToUpload']['name'],
        'laptop_nama' => $_POST['laptop_nama'],
        'merk_id' => $_POST['merk_id'],
        'ram_id' => $_POST['ram_id'],
        'kapasitas' => $_POST['kapasitas'],
        'sistem_operasi' => $_POST['sistem_operasi']
    ];
 
    $file = $_FILES['fotoToUpload'];
 
    $result = $laptop->updateLaptop($id, $data, $file);
    if ($result > 0) {
        // jika update sukses, tampilkan alert
        echo "<script> alert('Data berhasil diupdate!'); document.location.href = 'index.php'; </script>";
    } else {
        echo "<script> alert('Data gagal diupdate!'); document.location.href = 'index.php'; </script>";
    }
}

$merkData = null;
$ramData = null;

// untuk list merk
while ($me = $merk->getResult()) {
    $selected = ($me['merk_id'] == $merk_terpilih) ? 'selected' : '';
    $merkData .= '<option value="' . $me['merk_id'] . '" ' . $selected . '>' . $me['merk_nama'] . '</option>';
}

// untuk list ram
while ($ra = $ram->getResult()) {
    $selected = ($ra['ram_id'] == $ram_terpilih) ? 'selected' : '';
    $ramData .= '<option value="' . $ra['ram_id'] . '" ' . $selected . '>' . $ra['ram_ukuran'] . '</option>'; 
}

$judul = 'Update';
$keterangan = '(Abaikan jika tidak akan mengganti foto)';

// buat instance template
$view = new Template('templates/skinform.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_TAMBAHAN', $keterangan);
$view->replace('DATA_ID', $id);
$view->replace('DATA_NAMA', $data_nama);
$view->replace('DATA_KAPASITAS', $kapasitas);
$view->replace('DATA_SISTEM_OPERASI', $sistem_operasi);
$view->replace('DATA_FOTO', $data_foto);
$view->replace('DATA_MERK', $merkData);
$view->replace('DATA_RAM', $ramData);
$view->replace('DATA_BUTTON', "Update");

$view->write();
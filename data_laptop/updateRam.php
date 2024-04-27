<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ram.php');
include('classes/Template.php');

$id = $_GET['id'];
$ram = new Ram($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ram->open();
$ram->getRamById($id);
$row = $ram->getResult();
$dataUpdate = $row['ram_ukuran'];

$data = null;

if(isset($_POST['btn-simpan'])){
    $data = [
        'ram_ukuran' => $_POST['ram_ukuran'],
    ];

    $result = $ram->updateRam($id, $data);

    if ($result > 0) 
    {
          // jika penambahan sukses, tampilkan alert
          echo "
          <script>
              alert('Data berhasil diupdate!');
              document.location.href = 'ram.php';
          </script>";
    } 
    else 
    {
          echo "
          <script>
          alert('Data gagal diupdate!');
          document.location.href = 'ram.php';
          </script>
          ";
    }
}

$judul= 'Update';

// buat instance template
$view = new Template('templates/skinform_ram.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_ID', $id);
$view->replace('DATA_RAM', $dataUpdate); 
$view->replace('DATA_BUTTON', "Update");

$view->write();
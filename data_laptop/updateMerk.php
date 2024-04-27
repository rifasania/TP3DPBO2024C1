<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Template.php');

$id = $_GET['id'];
$merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$merk->open();
$merk->getMerkById($id);
$row = $merk->getResult();
$dataUpdate = $row['merk_nama'];

$data = null;

if(isset($_POST['btn-simpan'])){
    $data = [
        'merk_nama' => $_POST['merk_nama'],
    ];

    $result = $merk->updateMerk($id, $data);

    if ($result > 0) 
    {
          // jika penambahan sukses, tampilkan alert
          echo "
          <script>
              alert('Data berhasil diupdate!');
              document.location.href = 'merk.php';
          </script>";
    } 
    else 
    {
          echo "
          <script>
          alert('Data gagal diupdate!');
          document.location.href = 'merk.php';
          </script>
          ";
    }
}

$judul = 'Update';

// buat instance template
$view = new Template('templates/skinform_merk.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_ID', $id);
$view->replace('DATA_MERK', $dataUpdate); 
$view->replace('DATA_BUTTON', "Update");

$view->write();
<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Template.php');

$merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$merk->open();
$merk->getMerk();

$data = null;

if(isset($_POST['btn-simpan'])){
    $data = [
        'merk_nama' => $_POST['merk_nama'],
    ];

    $result = $merk->addMerk($data);

    if ($result > 0) 
    {
          // jika penambahan sukses, tampilkan alert
          echo "
          <script>
              alert('Data berhasil ditambahkan!');
              document.location.href = 'merk.php';
          </script>";
    } 
    else 
    {
          echo "
          <script>
          alert('Data gagal ditambahkan!');
          document.location.href = 'merk.php';
          </script>
          ";
    }
}

$judul = 'Tambah';

// buat instance template
$view = new Template('templates/skinform_merk.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_BUTTON', "Tambah");

$view->write();
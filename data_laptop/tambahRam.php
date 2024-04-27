<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ram.php');
include('classes/Template.php');

$ram = new Ram($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ram->open();
$ram->getRam();

$data = null;

if(isset($_POST['btn-simpan'])){
    $data = [
        'ram_ukuran' => $_POST['ram_ukuran'],
    ];

    $result = $ram->addRam($data);

    if ($result > 0) 
    {
          // jika penambahan sukses, tampilkan alert
          echo "
          <script>
              alert('Data berhasil ditambahkan!');
              document.location.href = 'ram.php';
          </script>";
    } 
    else 
    {
          echo "
          <script>
          alert('Data gagal ditambahkan!');
          document.location.href = 'tambahRam.php';
          </script>
          ";
    }
}

$judul = 'Tambah';

// buat instance template
$view = new Template('templates/skinform_ram.html');

// replace view
$view->replace('DATA_JUDUL', $judul);
$view->replace('DATA_BUTTON', "Tambah");

$view->write();
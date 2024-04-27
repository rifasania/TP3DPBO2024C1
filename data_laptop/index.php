<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Ram.php');
include('classes/Laptop.php');
include('classes/Template.php');

// buat instance Laptop
$listLaptop = new Laptop($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listLaptop->open();
// tampilkan data Laptop
$listLaptop->getLaptopJoin();

// cari Laptop
if (isset($_POST['btn-cari'])) {
    // methode mencari data Laptop
    $listLaptop->searchLaptop($_POST['cari']);
} else {
    // method menampilkan data Laptop
    $listLaptop->getLaptopJoin();
}

$data = null;

// ambil data laptop
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listLaptop->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['laptop_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['laptop_foto'] . '" class="card-img-top" alt="' . $row['laptop_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['laptop_nama'] . '</p>
                <p class="card-text divisi-nama">' . $row['ram_ukuran'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['merk_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listLaptop->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_LAPTOP', $data);
$home->write();
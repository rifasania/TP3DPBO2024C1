<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Ram.php');
include('classes/Laptop.php');
include('classes/Template.php');

$laptop = new Laptop($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$laptop->open();

$data = nulL;

// $lap = $laptop->getResult();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $laptop->getLaptopById($id);
        $row = $laptop->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail Laptop ' . $row['laptop_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['laptop_foto'] . '" class="img-thumbnail" alt="' . $row['laptop_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['laptop_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Kapasitas Penyimpanan</td>
                                    <td>:</td>
                                    <td>' . $row['kapasitas'] . '</td>
                                </tr>
                                <tr>
                                    <td>Sistem Operasi</td>
                                    <td>:</td>
                                    <td>' . $row['sistem_operasi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>:</td>
                                    <td>' . $row['merk_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>RAM</td>
                                    <td>:</td>
                                    <td>' . $row['ram_ukuran'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="updateLaptop.php?id=' . $row['laptop_id'] . '" title="Edit Data"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['laptop_id'] . '" title="Delete Data"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($laptop->deleteLaptop($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$laptop->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->write();

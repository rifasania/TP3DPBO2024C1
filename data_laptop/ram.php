<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ram.php');
include('classes/Template.php');

$ram = new Ram($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ram->open();
$ram->getRam();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($ram->addRam($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'ram.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'ram.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'RAM';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">RAM</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'ram';
$form = 'tambahRam.php';

while ($me = $ram->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $me['ram_ukuran'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateRam.php?id=' . $me['ram_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="ram.php?hapus=' . $me['ram_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($ram->updateRam($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'ram.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'ram.php';
            </script>";
            }
        }

        $ram->getRamById($id);
        $row = $ram->getResult();

        $dataUpdate = $row['ram_ukuran'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($ram->deleteRam($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'ram.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'ram.php';
            </script>";
        }
    }
}

$ram->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_FORM', $form);
$view->write();

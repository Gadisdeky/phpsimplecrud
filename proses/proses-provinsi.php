<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputStokvarianekslusif'){
    // Mengambil data provinsi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataStokVarianEkslusif = [
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputProvinsi untuk memasukkan data provinsi dengan parameter array $dataProvinsi
    $input = $master->inputStokvarianeklusif($dataStokVarianEkslusif);
    if($input){
        header("Location: ../master-provinsi-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-provinsi-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updateprovinsi'){
    // Mengambil data provinsi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataProvinsi = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateProvinsi untuk mengupdate data provinsi dengan parameter array $dataProvinsi
    $update = $master->updateStokvarianeklusif($dataStokVarianEkslusif);
    if($update){
        header("Location: ../master-provinsi-list.php?status=editsuccess");
    } else {
        header("Location: ../master-provinsi-edit.php?id=".$dataStokVarianEkslusif['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deleteprovinsi'){
    // Mengambil id provinsi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProvinsi untuk menghapus data provinsi berdasarkan id
    $delete = $master->deleteStokvarianeklusif($id);
    if($delete){
        header("Location: ../master-Varia-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-provinsi-list.php?status=deletefailed");
    }
}

?>
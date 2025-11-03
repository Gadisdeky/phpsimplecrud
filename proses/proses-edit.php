<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-roti.php';
// Membuat objek dari class Mahasiswa
$roti = new roti();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataroti = [
                    'id' => $_POST['id_roti'],
                    'kode' => $_POST['Kode_roti'],
                    'varian' => $_POST['Nama_Varian_roti'],
                    'toping' => $_POST['Toping_roti'],
                    'jumlah' => $_POST['Jumlah_box_roti'],
                    'provinsi' => $_POST['Provinsi'],
                    'alamat' => $_POST['Alamat'],
                    'email' => $_POST['Email'],
                    'telp' => $_POST['Telp'],
                    'status' => $_POST['Status_pesanan']
];
// Memanggil method editMahasiswa untuk mengupdate data mahasiswa dengan parameter array $dataMahasiswa
$edit = $roti->editroti($dataroti);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id mahasiswa
    header("Location: ../data-edit.php?id=".$dataroti['id']."&status=failed");
}

?>
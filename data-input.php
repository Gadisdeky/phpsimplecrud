<?php 
include_once 'config/class-master.php';
$master = new MasterData();

$VarianList = $master->getvarianroti();
$Stokvarianekslusif = $master->getStokvarianekslusif();
$statusList = $master->getStatus();

if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data roti. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

<?php include 'template/navbar.php'; ?>
<?php include 'template/sidebar.php'; ?>

<main class="app-main">
<div class="app-content-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h3 class="mb-0">Input Roti</h3>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-end">
<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
<li class="breadcrumb-item active" aria-current="page">Input Data</li>
</ol>
</div>
</div>
</div>
</div>

<div class="app-content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Input Roti</h3>
</div>

<form action="proses/proses-input.php" method="POST">
<div class="card-body">
    <div class="mb-3">
        <label class="form-label">Kode Roti</label>
        <input type="number" class="form-control" name="kode" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Varian Roti</label>
        <input type="text" class="form-control" name="nama_varian_roti" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Toping Roti</label>
        <input type="text" class="form-control" name="toping_roti" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Box Roti</label>
        <input type="number" class="form-control" name="jumlah_box_roti" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" rows="3" required></textarea>
    </div>
   <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" rows="3" required></textarea>
    </div>
            <?php foreach($Stokvarianekslusif as $prov){ ?>
                <option value="<?= $prov['id'] ?>"><?= $prov['nama'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="tel" class="form-control" name="telp" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status_pesanan" required>
            <option value="" selected disabled>Pilih Status</option>
            <?php foreach ($statusList as $status){ ?>
                <option value="<?= $status['id'] ?>"><?= $status['nama'] ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-danger me-2" onclick="window.location.href='data-list.php'">Batal</button>
    <button type="reset" class="btn btn-secondary me-2">Reset</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

</div>
</div>
</div>
</div>
</div>

</main>
<?php include 'template/footer.php'; ?>
</div>
<?php include 'template/script.php'; ?>
</body>
</html>

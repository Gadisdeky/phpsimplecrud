<?php
include_once 'config/class-roti.php';
$roti = new roti();

// Pastikan $dataroti selalu array
$dataroti = $roti->getAllroti() ?? [];

// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
    if($_GET['status'] == 'inputsuccess'){
        echo "<script>alert('Data roti berhasil ditambahkan.');</script>";
    } else if($_GET['status'] == 'editsuccess'){
        echo "<script>alert('Data roti berhasil diubah.');</script>";
    } else if($_GET['status'] == 'deletesuccess'){
        echo "<script>alert('Data roti berhasil dihapus.');</script>";
    } else if($_GET['status'] == 'deletefailed'){
        echo "<script>alert('Gagal menghapus data roti. Silakan coba lagi.');</script>";
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
                        <h3 class="mb-0">Daftar Roti</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Roti</li>
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
                                <h3 class="card-title">Tabel Data Roti</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped" role="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama roti</th>
                                            <th>Varian Rasa</th>
                                            <th>Toping</th>
                                            <th>Jumlah</th>
                                            <th>Provinsi</th>
                                            <th>Alamat</th>
                                            <th>Telp</th>
                                            <th>Email</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(count($dataroti) == 0){
                                            echo '<tr class="align-middle">
                                                    <td colspan="12" class="text-center">Tidak ada data roti.</td>
                                                  </tr>';
                                        } else {
                                            foreach ($dataroti as $index => $roti){
                                                // Pastikan status aman
                                                $statusBadge = '<span class="badge bg-secondary">UNKNOWN</span>';
                                                if(isset($roti['Status_pesanan'])){
                                                    if($roti['Status_pesanan'] == 1) $statusBadge = '<span class="badge bg-success">CHECKOUT</span>';
                                                    elseif($roti['Status_pesanan'] == 2) $statusBadge = '<span class="badge bg-danger">CANCEL</span>';
                                                }

                                                echo '<tr class="align-middle">
                                                        <td>'.($index + 1).'</td>
                                                        <td>'.($roti['Kode_roti'] ?? '-').'</td>
                                                        <td>'.($roti['Nama_Varian_roti'] ?? '-').'</td>
                                                        <td>'.($roti['Varian'] ?? '-').'</td>
                                                        <td>'.($roti['Toping_roti'] ?? '-').'</td>
                                                        <td>'.($roti['Jumlah_box_roti'] ?? '-').'</td>
                                                        <td>'.($roti['Provinsi'] ?? '-').'</td>
                                                        <td>'.($roti['Alamat'] ?? '-').'</td>
                                                        <td>'.($roti['Telp'] ?? '-').'</td>
                                                        <td>'.($roti['Email'] ?? '-').'</td>
                                                        <td class="text-center">'.$statusBadge.'</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.($roti['id_roti'] ?? 0).'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data roti ini?\')){window.location.href=\'proses/proses-delete.php?id='.($roti['id_roti'] ?? 0).'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
                                                        </td>
                                                      </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Roti</button>
                            </div>
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

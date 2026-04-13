<?php
require_once 'functions_anggota.php';

$anggota_list = [
    ["id"=>"AGT-001","nama"=>"Budi","email"=>"budi@mail.com","telepon"=>"081","alamat"=>"Jakarta","tanggal_daftar"=>"2024-01-10","status"=>"Aktif","total_pinjaman"=>5],
    ["id"=>"AGT-002","nama"=>"Siti","email"=>"siti@mail.com","telepon"=>"082","alamat"=>"Bandung","tanggal_daftar"=>"2024-02-12","status"=>"Aktif","total_pinjaman"=>8],
    ["id"=>"AGT-003","nama"=>"Andi","email"=>"andi@mail.com","telepon"=>"083","alamat"=>"Surabaya","tanggal_daftar"=>"2024-03-01","status"=>"Non-Aktif","total_pinjaman"=>2],
    ["id"=>"AGT-004","nama"=>"Dewi","email"=>"dewi@mail.com","telepon"=>"084","alamat"=>"Jogja","tanggal_daftar"=>"2024-01-20","status"=>"Aktif","total_pinjaman"=>10],
    ["id"=>"AGT-005","nama"=>"Rizky","email"=>"rizky@mail.com","telepon"=>"085","alamat"=>"Medan","tanggal_daftar"=>"2024-04-05","status"=>"Non-Aktif","total_pinjaman"=>1]
];

// Statistik
$total = hitung_total_anggota($anggota_list);
$aktif = hitung_anggota_aktif($anggota_list);
$rata = hitung_rata_rata_pinjaman($anggota_list);
$teraktif = cari_anggota_teraktif($anggota_list);

$nonaktif = $total - $aktif;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<h2 class="mb-4">📚 Sistem Anggota Perpustakaan</h2>

<!-- CARD STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                Total: <?= $total ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                Aktif: <?= $aktif ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                Non-Aktif: <?= $nonaktif ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                Rata Pinjaman: <?= round($rata,1) ?>
            </div>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card mb-4">
<div class="card-header bg-primary text-white">Daftar Anggota</div>
<div class="card-body">

<table class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Status</th>
<th>Total Pinjaman</th>
</tr>
</thead>

<tbody>
<?php foreach ($anggota_list as $a): ?>
<tr>
<td><?= $a['id'] ?></td>
<td><?= $a['nama'] ?></td>
<td>
    <?php if($a['status']=="Aktif"): ?>
        <span class="badge bg-success">Aktif</span>
    <?php else: ?>
        <span class="badge bg-danger">Non-Aktif</span>
    <?php endif; ?>
</td>
<td><?= $a['total_pinjaman'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

</div>
</div>

<!-- TERAKTIF -->
<div class="card mb-4">
<div class="card-header bg-success text-white">Anggota Teraktif</div>
<div class="card-body">
    <b><?= $teraktif['nama'] ?></b> (<?= $teraktif['total_pinjaman'] ?> pinjaman)
</div>
</div>

<!-- LIST AKTIF & NON -->
<div class="row">
<div class="col-md-6">
<h5>Anggota Aktif</h5>
<ul class="list-group">
<?php foreach (filter_by_status($anggota_list,"Aktif") as $a): ?>
<li class="list-group-item"><?= $a['nama'] ?></li>
<?php endforeach; ?>
</ul>
</div>

<div class="col-md-6">
<h5>Anggota Non-Aktif</h5>
<ul class="list-group">
<?php foreach (filter_by_status($anggota_list,"Non-Aktif") as $a): ?>
<li class="list-group-item"><?= $a['nama'] ?></li>
<?php endforeach; ?>
</ul>
</div>
</div>

</div>
</body>
</html>
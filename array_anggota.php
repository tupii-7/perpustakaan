<?php
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Siti Aminah",
        "email" => "siti@email.com",
        "telepon" => "082233445566",
        "alamat" => "Bandung",
        "tanggal_daftar" => "2024-02-10",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Andi Wijaya",
        "email" => "andi@email.com",
        "telepon" => "083344556677",
        "alamat" => "Surabaya",
        "tanggal_daftar" => "2024-03-05",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Dewi Lestari",
        "email" => "dewi@email.com",
        "telepon" => "084455667788",
        "alamat" => "Yogyakarta",
        "tanggal_daftar" => "2024-01-25",
        "status" => "Aktif",
        "total_pinjaman" => 10
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rizky Pratama",
        "email" => "rizky@email.com",
        "telepon" => "085566778899",
        "alamat" => "Medan",
        "tanggal_daftar" => "2024-04-01",
        "status" => "Non-Aktif",
        "total_pinjaman" => 1
    ]
];

// Statistik
$total_anggota = count($anggota_list);

$aktif = 0;
$nonaktif = 0;
$total_pinjaman = 0;
$teraktif = $anggota_list[0];

foreach ($anggota_list as $a) {
    if ($a['status'] == "Aktif") {
        $aktif++;
    } else {
        $nonaktif++;
    }

    $total_pinjaman += $a['total_pinjaman'];

    if ($a['total_pinjaman'] > $teraktif['total_pinjaman']) {
        $teraktif = $a;
    }
}

$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_nonaktif = ($nonaktif / $total_anggota) * 100;
$rata_pinjaman = $total_pinjaman / $total_anggota;

// Filter
$filter = $_GET['status'] ?? 'Semua';

$filtered_list = array_filter($anggota_list, function($a) use ($filter) {
    if ($filter == 'Semua') return true;
    return $a['status'] == $filter;
});
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">📚 Data Anggota Perpustakaan</h2>

    <!-- CARD STATISTIK -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h3><?= $total_anggota ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Aktif</h5>
                    <h3><?= round($persen_aktif) ?>%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Non-Aktif</h5>
                    <h3><?= round($persen_nonaktif) ?>%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Rata Pinjaman</h5>
                    <h3><?= round($rata_pinjaman,1) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- TERAKTIF -->
    <div class="alert alert-info">
        Anggota Teraktif: <b><?= $teraktif['nama'] ?></b> (<?= $teraktif['total_pinjaman'] ?> pinjaman)
    </div>

    <!-- FILTER -->
    <form method="GET" class="mb-3">
        <select name="status" class="form-select w-25" onchange="this.form.submit()">
            <option <?= $filter=='Semua'?'selected':'' ?>>Semua</option>
            <option <?= $filter=='Aktif'?'selected':'' ?>>Aktif</option>
            <option <?= $filter=='Non-Aktif'?'selected':'' ?>>Non-Aktif</option>
        </select>
    </form>

    <!-- TABEL -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Total Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filtered_list as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['nama'] ?></td>
                <td><?= $a['email'] ?></td>
                <td>
                    <?php if($a['status']=="Aktif"): ?>
                        <span class="badge bg-success">Aktif</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Non-Aktif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?= $a['total_pinjaman'] ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
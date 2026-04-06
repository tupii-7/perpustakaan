<?php
// Data Anggota
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5;

// Aturan
$maks_pinjaman = 3;
$denda_per_hari = 1000;
$maks_denda = 50000;

// Hitung denda
$total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;
if ($total_denda > $maks_denda) {
    $total_denda = $maks_denda;
}

// Status (IF-ELSEIF-ELSE)
if ($buku_terlambat > 0) {
    $status = "Tidak bisa meminjam";
    $warna_status = "danger";
    $icon_status = "exclamation-triangle";
} elseif ($total_pinjaman >= $maks_pinjaman) {
    $status = "Batas pinjaman tercapai";
    $warna_status = "warning";
    $icon_status = "slash-circle";
} else {
    $status = "Bisa meminjam buku";
    $warna_status = "success";
    $icon_status = "check-circle";
}

// Level Member (SWITCH)
switch (true) {
    case ($total_pinjaman <= 5):
        $level = "Bronze";
        $warna_level = "secondary";
        $icon_level = "person";
        break;
    case ($total_pinjaman <= 15):
        $level = "Silver";
        $warna_level = "primary";
        $icon_level = "star";
        break;
    default:
        $level = "Gold";
        $warna_level = "warning";
        $icon_level = "trophy";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">
        <i class="bi bi-journal-bookmark"></i> Status Peminjaman Anggota
    </h2>

    <div class="row">
        <div class="col-md-6">

            <!-- Card Utama -->
            <div class="card border-<?php echo $warna_status; ?>">
                <div class="card-header bg-<?php echo $warna_status; ?> text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-<?php echo $icon_status; ?>"></i>
                        <?php echo $nama_anggota; ?>
                    </h5>
                </div>

                <div class="card-body">

                    <p>
                        Total Pinjaman:
                        <span class="badge bg-info"><?php echo $total_pinjaman; ?></span>
                    </p>

                    <p>
                        Buku Terlambat:
                        <span class="badge bg-danger"><?php echo $buku_terlambat; ?></span>
                    </p>

                    <p>
                        Status:
                        <span class="badge bg-<?php echo $warna_status; ?>">
                            <?php echo $status; ?>
                        </span>
                    </p>

                    <p>
                        Level Member:
                        <span class="badge bg-<?php echo $warna_level; ?>">
                            <i class="bi bi-<?php echo $icon_level; ?>"></i>
                            <?php echo $level; ?>
                        </span>
                    </p>

                    <?php if ($buku_terlambat > 0): ?>
                        <div class="alert alert-danger mt-3">
                            <i class="bi bi-exclamation-circle"></i>
                            Denda: Rp <?php echo number_format($total_denda, 0, ',', '.'); ?><br>
                            Harap segera mengembalikan buku!
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
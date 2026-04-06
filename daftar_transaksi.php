<?php
$total_transaksi = 0;
$total_dipinjam = 0;
$total_dikembalikan = 0;

// Loop pertama: hitung statistik
for ($i = 1; $i <= 10; $i++) {

    if ($i % 2 == 0) continue; // skip genap
    if ($i == 8) break; // stop di 8

    $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

    $total_transaksi++;

    if ($status == "Dipinjam") {
        $total_dipinjam++;
    } else {
        $total_dikembalikan++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Daftar Transaksi Peminjaman</h2>

    <!-- Statistik -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h5>Total Transaksi</h5>
                    <span class="badge bg-primary fs-5"><?php echo $total_transaksi; ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h5>Masih Dipinjam</h5>
                    <span class="badge bg-warning fs-5"><?php echo $total_dipinjam; ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h5>Sudah Dikembalikan</h5>
                    <span class="badge bg-success fs-5"><?php echo $total_dikembalikan; ?></span>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Hari</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $no = 1;

        for ($i = 1; $i <= 10; $i++) {

            if ($i % 2 == 0) continue; // skip genap
            if ($i == 8) break; // stop di 8

            $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
            $nama_peminjam = "Anggota " . $i;
            $judul_buku = "Buku Teknologi Vol. " . $i;
            $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
            $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

            // Hitung selisih hari
            $hari = floor((time() - strtotime($tanggal_pinjam)) / (60*60*24));

            // Warna status
            if ($status == "Dipinjam") {
                $badge = "warning";
            } else {
                $badge = "success";
            }
        ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $id_transaksi; ?></td>
                <td><?php echo $nama_peminjam; ?></td>
                <td><?php echo $judul_buku; ?></td>
                <td><?php echo $tanggal_pinjam; ?></td>
                <td><?php echo $tanggal_kembali; ?></td>
                <td><?php echo $hari; ?> hari</td>
                <td>
                    <span class="badge bg-<?php echo $badge; ?>">
                        <?php echo $status; ?>
                    </span>
                </td>
            </tr>

        <?php } ?>

        </tbody>
    </table>

</div>

</body>
</html>
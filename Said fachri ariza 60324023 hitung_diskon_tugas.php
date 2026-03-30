<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
        
        <?php
        // TODO: Isi data pembeli dan buku di sini
        $nama_pembeli = "Budi Santoso";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 4;
        $is_member = true; // true atau false
        
        // TODO: Hitung subtotal
        $subtotal = $harga_satuan * $jumlah_beli; // Lengkapi perhitungan
        
        // TODO: Tentukan persentase diskon berdasarkan jumlah
        if ($jumlah_beli >= 3) 
        {
            $persentase_diskon = 10;
        } else 
        {
            $persentase_diskon = 0;
        }
 // Gunakan if-else atau switch
        
        // TODO: Hitung diskon
        $diskon = ($persentase_diskon / 100) * $subtotal; // Lengkapi perhitungan
        
        // TODO: Total setelah diskon pertama
        $total_setelah_diskon1 = $subtotal - $diskon; // Lengkapi
        
        // TODO: Hitung diskon member jika member
        $diskon_member = 0;
        if ($is_member) {
           $diskon_member = 0.05 * $total_setelah_diskon1;
        }
        
        // TODO: Total setelah semua diskon
        $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member; // Lengkapi
        
        // TODO: Hitung PPN
        $ppn = 0.11 * $total_setelah_diskon; // Lengkapi
        
        // TODO: Total akhir
        $total_akhir = $total_setelah_diskon + $ppn; // Lengkapi
        
        // TODO: Total penghematan
        $total_hemat =  $diskon + $diskon_member; // Lengkapi
        ?>
        
        <!-- TODO: Tampilkan hasil perhitungan dengan Bootstrap -->
        <!-- Gunakan card, table, dan badge -->
        
    </div>
    <div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Detail Pembelian</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Pembeli</th>
                    <td><?= $nama_pembeli; ?></td>
                </tr>
                <tr>
                    <th>Judul Buku</th>
                    <td><?= $judul_buku; ?></td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>Rp <?= number_format($harga_satuan, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?= $jumlah_beli; ?> buku</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if($is_member): ?>
                            <span class="badge bg-success">Member</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Non Member</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <hr>

            <h6>Perhitungan</h6>
            <table class="table table-bordered">
                <tr>
                    <th>Subtotal</th>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Diskon (<?= $persentase_diskon; ?>%)</th>
                    <td class="text-danger">- Rp <?= number_format($diskon, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Diskon Member (5%)</th>
                    <td class="text-danger">- Rp <?= number_format($diskon_member, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Total setelah diskon</th>
                    <td>Rp <?= number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>PPN (11%)</th>
                    <td>Rp <?= number_format($ppn, 0, ',', '.'); ?></td>
                </tr>
                <tr class="table-success">
                    <th>Total Akhir</th>
                    <td><strong>Rp <?= number_format($total_akhir, 0, ',', '.'); ?></strong></td>
                </tr>
                <tr>
                    <th>Total Hemat</th>
                    <td class="text-success">Rp <?= number_format($total_hemat, 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
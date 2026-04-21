<?php
$buku_list = [
    ["kode"=>"B001","judul"=>"Algoritma Dasar","kategori"=>"Informatika","pengarang"=>"Andi","penerbit"=>"Erlangga","tahun"=>2020,"harga"=>75000,"stok"=>5],
    ["kode"=>"B002","judul"=>"Struktur Data","kategori"=>"Informatika","pengarang"=>"Budi","penerbit"=>"Gramedia","tahun"=>2019,"harga"=>85000,"stok"=>0],
    ["kode"=>"B003","judul"=>"Matematika Diskrit","kategori"=>"Matematika","pengarang"=>"Citra","penerbit"=>"Erlangga","tahun"=>2021,"harga"=>90000,"stok"=>3],
    ["kode"=>"B004","judul"=>"Basis Data","kategori"=>"Informatika","pengarang"=>"Dedi","penerbit"=>"Gramedia","tahun"=>2018,"harga"=>80000,"stok"=>2],
    ["kode"=>"B005","judul"=>"Pemrograman PHP","kategori"=>"Programming","pengarang"=>"Eka","penerbit"=>"Informatika","tahun"=>2022,"harga"=>95000,"stok"=>7],
    ["kode"=>"B006","judul"=>"Jaringan Komputer","kategori"=>"Networking","pengarang"=>"Fajar","penerbit"=>"Erlangga","tahun"=>2020,"harga"=>88000,"stok"=>0],
    ["kode"=>"B007","judul"=>"Machine Learning","kategori"=>"AI","pengarang"=>"Gilang","penerbit"=>"Gramedia","tahun"=>2023,"harga"=>120000,"stok"=>4],
    ["kode"=>"B008","judul"=>"Deep Learning","kategori"=>"AI","pengarang"=>"Hana","penerbit"=>"Informatika","tahun"=>2021,"harga"=>130000,"stok"=>6],
    ["kode"=>"B009","judul"=>"Web Development","kategori"=>"Programming","pengarang"=>"Indra","penerbit"=>"Erlangga","tahun"=>2019,"harga"=>70000,"stok"=>1],
    ["kode"=>"B010","judul"=>"UI UX Design","kategori"=>"Design","pengarang"=>"Joko","penerbit"=>"Gramedia","tahun"=>2022,"harga"=>95000,"stok"=>0],
];

$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$status = $_GET['status'] ?? 'semua';
$sort = $_GET['sort'] ?? 'judul';
$page = $_GET['page'] ?? 1;

$errors = [];
$current_year = date("Y");

if ($min_harga && $max_harga && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
}
if ($tahun && ($tahun < 1900 || $tahun > $current_year)) {
    $errors[] = "Tahun tidak valid";
}

$hasil = array_filter($buku_list, function($b) use ($keyword,$kategori,$min_harga,$max_harga,$tahun,$status){
    if ($keyword && !stripos($b['judul'].$b['pengarang'], $keyword)) return false;
    if ($kategori && $b['kategori'] != $kategori) return false;
    if ($min_harga && $b['harga'] < $min_harga) return false;
    if ($max_harga && $b['harga'] > $max_harga) return false;
    if ($tahun && $b['tahun'] != $tahun) return false;
    if ($status == "tersedia" && $b['stok'] <= 0) return false;
    if ($status == "habis" && $b['stok'] > 0) return false;
    return true;
});

usort($hasil, function($a,$b) use ($sort){
    return $a[$sort] <=> $b[$sort];
});

$per_page = 10;
$total = count($hasil);
$start = ($page - 1) * $per_page;
$hasil_page = array_slice($hasil, $start, $per_page);

function highlight($text, $keyword){
    if(!$keyword) return $text;
    return preg_replace("/($keyword)/i", "<mark>$1</mark>", $text);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">📚 Pencarian Buku</h3>

    <?php foreach($errors as $e): ?>
        <div class="alert alert-danger"><?= $e ?></div>
    <?php endforeach; ?>

    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row g-2">
            <input type="text" name="keyword" class="form-control" placeholder="Keyword..." value="<?= $keyword ?>">
            
            <select name="kategori" class="form-control">
                <option value="">Semua Kategori</option>
                <?php
                $kategori_list = array_unique(array_column($buku_list, 'kategori'));
                foreach($kategori_list as $k){
                    echo "<option ".($kategori==$k?'selected':'').">$k</option>";
                }
                ?>
            </select>

            <input type="number" name="min_harga" class="form-control" placeholder="Min Harga" value="<?= $min_harga ?>">
            <input type="number" name="max_harga" class="form-control" placeholder="Max Harga" value="<?= $max_harga ?>">
            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?= $tahun ?>">

            <select name="sort" class="form-control">
                <option value="judul">Sort Judul</option>
                <option value="harga">Sort Harga</option>
                <option value="tahun">Sort Tahun</option>
            </select>

            <div>
                <label><input type="radio" name="status" value="semua" <?= $status=="semua"?"checked":"" ?>> Semua</label>
                <label><input type="radio" name="status" value="tersedia" <?= $status=="tersedia"?"checked":"" ?>> Tersedia</label>
                <label><input type="radio" name="status" value="habis" <?= $status=="habis"?"checked":"" ?>> Habis</label>
            </div>

            <button class="btn btn-primary">Cari</button>
        </div>
    </form>

    <p><strong><?= $total ?></strong> hasil ditemukan</p>

    <div class="row">
        <?php foreach($hasil_page as $b): ?>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5><?= highlight($b['judul'],$keyword) ?></h5>
                    <span class="badge bg-secondary"><?= $b['kategori'] ?></span>
                    <p class="mt-2 mb-1">👤 <?= highlight($b['pengarang'],$keyword) ?></p>
                    <p class="mb-1">📅 <?= $b['tahun'] ?></p>
                    <p class="mb-1">💰 Rp<?= number_format($b['harga']) ?></p>

                    <?php if($b['stok'] > 0): ?>
                        <span class="badge bg-success">Tersedia (<?= $b['stok'] ?>)</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Habis</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <nav>
        <ul class="pagination">
            <?php for($i=1;$i<=ceil($total/$per_page);$i++): ?>
            <li class="page-item <?= $i==$page?'active':'' ?>">
                <a class="page-link" href="?<?= http_build_query(array_merge($_GET,['page'=>$i])) ?>">
                    <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>

</div>

</body>
</html>
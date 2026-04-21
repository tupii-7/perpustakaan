<?php
$errors = [];
$data = [
    'nama' => '',
    'email' => '',
    'telepon' => '',
    'alamat' => '',
    'gender' => '',
    'tgl_lahir' => '',
    'pekerjaan' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($data as $key => $val) {
        $data[$key] = trim($_POST[$key] ?? '');
    }

    if (strlen($data['nama']) < 3) {
    $errors['nama'] = "Nama minimal 3 karakter";
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $data['nama'])) {
    $errors['nama'] = "Nama hanya boleh huruf dan spasi";
}

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email tidak valid";
    }

    if (!preg_match('/^08\d{8,11}$/', $data['telepon'])) {
        $errors['telepon'] = "Format telepon harus 08xxxxxxxxxx";
    }

    if (strlen($data['alamat']) < 10) {
        $errors['alamat'] = "Alamat minimal 10 karakter";
    }

    if (!$data['gender']) {
        $errors['gender'] = "Pilih jenis kelamin";
    }

    if ($data['tgl_lahir']) {
        $birth = new DateTime($data['tgl_lahir']);
        $today = new DateTime();
        $age = $today->diff($birth)->y;

        if ($age < 10) {
            $errors['tgl_lahir'] = "Umur minimal 10 tahun";
        }
    } else {
        $errors['tgl_lahir'] = "Tanggal lahir wajib diisi";
    }

    if (!$data['pekerjaan']) {
        $errors['pekerjaan'] = "Pilih pekerjaan";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h3 class="mb-4">📝 Form Biodata</h3>

    <form method="POST" class="card p-4 shadow-sm mb-4">

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control <?= isset($errors['nama'])?'is-invalid':'' ?>" value="<?= $data['nama'] ?>">
            <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control <?= isset($errors['email'])?'is-invalid':'' ?>" value="<?= $data['email'] ?>">
            <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control <?= isset($errors['telepon'])?'is-invalid':'' ?>" value="<?= $data['telepon'] ?>">
            <div class="invalid-feedback"><?= $errors['telepon'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control <?= isset($errors['alamat'])?'is-invalid':'' ?>"><?= $data['alamat'] ?></textarea>
            <div class="invalid-feedback"><?= $errors['alamat'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label><br>
            <input type="radio" name="gender" value="Laki-laki" <?= $data['gender']=="Laki-laki"?'checked':'' ?>> Laki-laki
            <input type="radio" name="gender" value="Perempuan" <?= $data['gender']=="Perempuan"?'checked':'' ?>> Perempuan
            <div class="text-danger"><?= $errors['gender'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control <?= isset($errors['tgl_lahir'])?'is-invalid':'' ?>" value="<?= $data['tgl_lahir'] ?>">
            <div class="invalid-feedback"><?= $errors['tgl_lahir'] ?? '' ?></div>
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <select name="pekerjaan" class="form-control <?= isset($errors['pekerjaan'])?'is-invalid':'' ?>">
                <option value="">Pilih</option>
                <?php
                $opsi = ["Pelajar","Mahasiswa","Pegawai","Lainnya"];
                foreach($opsi as $o){
                    echo "<option ".($data['pekerjaan']==$o?'selected':'').">$o</option>";
                }
                ?>
            </select>
            <div class="invalid-feedback"><?= $errors['pekerjaan'] ?? '' ?></div>
        </div>

        <button class="btn btn-primary">Submit</button>

    </form>

    <?php if ($_SERVER['REQUEST_METHOD']==='POST' && empty($errors)): ?>
        <div class="card shadow-sm p-4">
            <h5 class="text-success">✅ Data berhasil disubmit</h5>
            <p><strong>Nama:</strong> <?= $data['nama'] ?></p>
            <p><strong>Email:</strong> <?= $data['email'] ?></p>
            <p><strong>Telepon:</strong> <?= $data['telepon'] ?></p>
            <p><strong>Alamat:</strong> <?= $data['alamat'] ?></p>
            <p><strong>Jenis Kelamin:</strong> <?= $data['gender'] ?></p>
            <p><strong>Tanggal Lahir:</strong> <?= $data['tgl_lahir'] ?></p>
            <p><strong>Pekerjaan:</strong> <?= $data['pekerjaan'] ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
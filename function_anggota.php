<?php

// 1. Total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $count = 0;
    foreach ($anggota_list as $a) {
        if ($a['status'] == "Aktif") {
            $count++;
        }
    }
    return $count;
}

// 3. Rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $a) {
        $total += $a['total_pinjaman'];
    }
    return count($anggota_list) > 0 ? $total / count($anggota_list) : 0;
}

// 4. Cari by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $a) {
        if ($a['id'] == $id) {
            return $a;
        }
    }
    return null;
}

// 5. Anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $max = $anggota_list[0];
    foreach ($anggota_list as $a) {
        if ($a['total_pinjaman'] > $max['total_pinjaman']) {
            $max = $a;
        }
    }
    return $max;
}

// 6. Filter status
function filter_by_status($anggota_list, $status) {
    return array_filter($anggota_list, function($a) use ($status) {
        return $a['status'] == $status;
    });
}

// 7. Validasi email
function validasi_email($email) {
    return !empty($email) && strpos($email, "@") !== false && strpos($email, ".") !== false;
}

// 8. Format tanggal Indo
function format_tanggal_indo($tanggal) {
    $bulan = [
        1=>"Januari","Februari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"
    ];

    $pecah = explode("-", $tanggal);
    return $pecah[2] . " " . $bulan[(int)$pecah[1]] . " " . $pecah[0];
}

?>
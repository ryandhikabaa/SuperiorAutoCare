<?php
include "conn.php";

function emptyChecker(){
    foreach ($_POST as $v) {
        if (empty($v)) {
            return true;
        }
    }
    return false;
}
if (emptyChecker()) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('status' => 'Failure', 'message' => "Input kosong"));
} else {
    $nama_pelanggan = $_POST["nama-pelanggan"];
    $nomor_telepon = $_POST["nomor-telepon"];
    $nomor_kendaraan = $_POST["nomor-kendaraan"];
    $tipe_kendaraan = $_POST["tipe-kendaraan"];
    $paket_dipilih = $_POST["paket-dipilih"];
    $waktu_reservasi = $_POST["waktu-reservasi"];

    $queries = "INSERT INTO tb_reservasi (nama_pelanggan, nomor_telepon, nomor_kendaraan, tipe_kendaraan, paket_dipilih, waktu_reservasi) VALUES ('$nama_pelanggan', '$nomor_telepon', '$nomor_kendaraan', '$tipe_kendaraan', '$paket_dipilih', '$waktu_reservasi')";

    $result = $conn->query($queries);
    header('Content-Type: application/json; charset=utf-8');
    if ($result === TRUE) {
        echo json_encode(array('status' => 'OK', 'message' => "Reservasi anda berhasil"));
    } else {
        echo json_encode(array('status' => 'Failure', 'message' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
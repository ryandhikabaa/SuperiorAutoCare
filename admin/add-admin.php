<?php
include "conn.php";

if (!isset($_POST["username"], $_POST["password"])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('status' => 'Failure', 'message' => "input is null"));
} else {
    $username = $_POST["username"];
    $options = [
        'cost' => 12,
    ];
    // Jika password encrypt
    // $password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);
    // Jika password not encrypt
    $password = $_POST["password"];


    $queries = "INSERT INTO tb_admin (username, password) VALUES ('$username', '$password')";

    $result = $conn->query($queries);
    header('Content-Type: application/json; charset=utf-8');
    if ($result === TRUE) {
        echo json_encode(array('status' => 'OK', 'message' => "Reservasi berhasil!"));
    } else {
        echo json_encode(array('status' => 'Failure', 'message' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
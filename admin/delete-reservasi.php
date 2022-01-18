<?php 

isset($_GET["id"]) ? null : header('Location: ./');

include "conn.php";

$id = $_GET["id"];
$sql = "DELETE FROM tb_reservasi WHERE id='$id'";
$result = $conn->query($sql);

if ($result === TRUE) {
    header('Location:./');
} else {
    echo json_encode(array('status' => 'Failure', 'message' => "Error: " . $sql . "<br>" . $conn->error));
}


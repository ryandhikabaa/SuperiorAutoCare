<!DOCTYPE html>
<html lang="en">
<?php
include "conn.php";

session_start();
isset($_SESSION["user"]) ? null : header('Location: login.php');

$queries = "SELECT * FROM tb_reservasi";

$result = $conn->query($queries);

?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>Superior Auto Care - Admin Panel</title>
</head>
<body>
    <nav id="navbar-top" class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
        <a class="navbar-brand ms-5 fs-3 fw-bold" href="http://localhost/SuperiorAutoCare/admin/">Superior Auto Care - Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item active">
            <a class="nav-link text-black" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </nav>
    <div class="px-5">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nomor Telepon</th>
                    <th>Nomor Kendaraan</th>
                    <th>Tipe Kendaraan</th>
                    <th>Paket Dipilih</th>
                    <th>Waktu Reservasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                    // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $row["nama_pelanggan"] ."</td>";
                            echo "<td>". $row["nomor_telepon"] ."</td>";
                            echo "<td>". $row["nomor_kendaraan"] ."</td>";
                            echo "<td class='text-capitalize'>". $row["tipe_kendaraan"] ."</td>";
                            echo "<td class='text-capitalize'>". $row["paket_dipilih"] ."</td>";
                            echo "<td>". $row["waktu_reservasi"] ."</td>";
                            echo "<td>";
                            echo "<a class='mx-2' href='edit-reservasi.php?id=". $row["id"] ."'><button class='btn btn-warning text-white rounded'>EDIT <i class='bi bi-trash-fill'></i></button></a>";
                            echo "<a class='mx-2' href='delete-reservasi.php?id=". $row["id"] ."'><button class='btn btn-danger text-white rounded'>DELETE <i class='bi bi-pencil-fill'></i></i></button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Nomor Telepon</th>
                    <th>Nomor Kendaraan</th>
                    <th>Tipe Kendaraan</th>
                    <th>Paket Dipilih</th>
                    <th>Waktu Reservasi</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</html>

<?php
$conn->close();

<!doctype html>
<html lang="en">
<?php

isset($_GET["id"]) ? null : header('Location: ./');
include "conn.php";
$id = $_GET["id"];

if (isset($_POST["paket-dipilih"], $_POST["waktu-reservasi"])) {
  $paket_dipilih = $_POST["paket-dipilih"];
  $waktu_reservasi = $_POST["waktu-reservasi"];

  $sql = "UPDATE tb_reservasi SET paket_dipilih='$paket_dipilih', waktu_reservasi='$waktu_reservasi' WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result === TRUE) {
    header('Location:./');
  } else {
    echo json_encode(array('status' => 'Failure', 'message' => "Error: " . $sql . "<br>" . $conn->error));
  }
}
$sql = "SELECT paket_dipilih, waktu_reservasi FROM tb_reservasi WHERE id='$id'";
$result = $conn->query($sql);
$form_fill = $result->fetch_assoc();

if (empty($form_fill)) {
  die("DATA NOT FOUND");
}
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  </script>

  <title>Superior Auto Care</title>
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
          <a class="nav-link text-white" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container py -3">
    <form class="needs-validation w-100 mx-auto" novalidate="" id="form-reservasi" method="POST" action="">
      <div class="row g-3">

        <div class="col-sm-6">
          <label for="padi" class="form-label">Paket Dipilih</label>
          <select name="paket-dipilih" class="form-select" autocomplete="off">
            <?php
            $options = ["car wash", "eksterior detail", "glass treatment", "diamond coating", "interior detail", "full package"];
            foreach ($options as $v) {
              $option = $form_fill["paket_dipilih"] == $v ? "<option value='$v' selected>" . ucfirst($v) . "</option>" : "<option value='$v'>" . ucfirst($v) . "</option>";
              echo $option;
            }
            ?>
          </select>
          <div class="invalid-feedback">
            Pilihan Paket is required.
          </div>
        </div>

        <div class="col-sm-6">
          <label for="wares" class="form-label">Waktu Reservasi</label>
          <input name="waktu-reservasi" id="datetimepicker" type="text" class="form-control" readonly placeholder="Waktu Reservasi..." value="<?php echo $form_fill["waktu_reservasi"] ?>" required="">
          <div class="invalid-feedback">
            Waktu Reservasi is required.
          </div>
        </div>
      </div>
      <button class="w-100 btn btn-primary btn-lg my-3" type="submit">EDIT</button>

    </form>
  </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="../assets/modules/datetimepicker-master/build/jquery.datetimepicker.min.css" rel="stylesheet">
<script src="../assets/modules/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script>
  $.datetimepicker.setLocale('en');
  $('#datetimepicker').datetimepicker();
</script>

</html>
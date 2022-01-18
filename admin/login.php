<!DOCTYPE html>
<html lang="en">
<?php

session_start();
!isset($_SESSION["user"]) ? null : header('Location: ./');

if (isset($_POST["username"], $_POST["password"])) {
    include "conn.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $queries = "SELECT * FROM tb_admin WHERE username=?";

    $stmt = $conn->prepare($queries);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // verifikasi password
        // if(password_verify($password, $user["password"])){
        if ($password == $user["password"]) {
            // buat Session
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: ./");
        } else {
            $alert = "password tidak benar";
        }
    } else {
        $alert = "user tidak ditemukan";
    }

    $conn->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <form action="" method="post">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Sign in</h3>

                                <h5 class="mb-5">SuperiorAutoCare - Admin</h3>

                                <div class="form-outline mb-4">
                                    <input type="username" id="typeEmailX-2" class="form-control form-control-lg" name="username" />
                                    <label class="form-label" for="typeEmailX-2">Username</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    <?php echo isset($alert) ? "alert('$alert')" : null; ?>
</script>

</html>
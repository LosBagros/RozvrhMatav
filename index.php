<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Úvod | MatavRozvrh</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

    <?php
        if (isset($_SESSION['email'])) {
            echo '<div class="costumblock w-100">
                    <h1 class="text-center m-3">Úvod</h1>
                    <p class="text-center">Jste přihlášen jako: ' . $_SESSION['email'] . '</p>
                    <form action="server.php" method="POST">
                      <button type="submit" class="btn btn-primary w-100" name="logout" value="logout">Odhlásit se!</button>
                    </form>
                  </div>';
        } else {
            echo '<div class="costumblock w-100">
                    <h1 class="text-center m-3">Úvod</h1>
                    <p class="text-center">Nejste přihlášen</p>
                    <a href="login.php" class="btn btn-primary w-100 mt-3">Přihlásit se!</a>
                    <a href="registrace.php" class="btn btn-primary w-100 mt-3">Registrovat se!</a>
                  </div>';
        }
    ?>

</body>
</html>
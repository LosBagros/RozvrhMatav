<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Přihlášení | MatavRozvrh</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

  <div class="costumblock w-100">
    <h1 class="text-center m-3">Přihlášení</h1>
    <form action="server.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Heslo</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary w-100" name="login" value="login">Přihlásit se!</button>
    </form>
    <a href="index.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
    <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger mt-3" role="alert">
                ' . $_SESSION['error'] . '
              </div>';
      }
      unset($_SESSION['error']);
      ?>
  </div>

</body>
</html>
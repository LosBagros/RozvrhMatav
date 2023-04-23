<?php
  session_start();
  if(isset($_SESSION['email'])){
    header("Location:index.php");
    die();
  }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrace | MatavRozvrh</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

  <div class="costumblock w-100">
    <h1 class="text-center m-3">Registrace</h1>
    <form action="server.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Heslo</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Ověření hesla</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
        <div class="form-text confirm-message"></div>
      </div>
      <button type="submit" class="btn btn-primary w-100" name="register" value="register">Registrovat!</button>
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
  <?php require("scripts.php") ?>
    <script>
    $('#password_confirm').on('keyup', function () {

      $('.confirm-message').removeClass('text-success').removeClass('text-danger');

      let password = $('#password').val();
      let confirm_password = $('#password_confirm').val();

      if (confirm_password === password) {
        $('.confirm-message').text("Hesla se shodují!").addClass('text-success');
      }
      else {
        $('.confirm-message').text("Hesla se neshodují!").addClass('text-danger');
      }

    });
  </script>
</body>
</html>
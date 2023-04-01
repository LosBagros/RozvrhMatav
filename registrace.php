<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrace | </title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

  <div class="register w-100">
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
      </div>
      <button type="submit" class="btn btn-primary w-100" name="register" value="register">Registrovat!</button>
    </form>
  </div>

</body>
</html>
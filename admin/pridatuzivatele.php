<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat uživatele | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="costumblock w-100">
    <h1 class="text-center m-3">Nový uživatel</h1>
    <form action="manager.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email*</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Heslo*</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="form-text pass-message"></div>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Ověření hesla*</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
        <div class="form-text confirm-message"></div>
      </div>
        <div class="mb-3">
            <label for="name" class="form-label">Jméno</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Příjmení</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Třída</label>
            <select class="form-select" id="class" name="class_id">
                <?php
                    require '../mysql.php';
                    $sql = 'SELECT * FROM classes';
                    $result = mysqli_query($connect, $sql);

                    if($result) {
                        foreach($result as $row) {
                            echo '<option value="' . $row['class_id'] . '">' . $row['classname'] . '</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Admin</label>
            <input class="form-check-input" type="checkbox" name="is_admin" value="1">
        </div>
        <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger mt-3" role="alert">
                ' . $_SESSION['error'] . '
              </div>';
      }
      unset($_SESSION['error']);
      ?>
      <button type="submit" class="btn btn-success w-100 mt-3" id="regbtn" name="addUser" disabled>Registrovat!</button>
    </form>
    <a href="uzivatele.php" class="btn btn-primary w-100 mt-3">Zpět!</a>

    <?php require("scripts.php") ?>

    <script>
      $('#password').on('keyup', function () {

      $('.pass-message').removeClass('text-success').removeClass('text-danger');
      let password = $('#password').val();

      if (password.length < 8) {
        $('.pass-message').text("Heslo musí mít alespoň 8 znaků!").addClass('text-danger');
      } else {
        $('.pass-message').text("");
      }

    });
    $('#password_confirm').on('keyup', function () {

      $('.confirm-message').removeClass('text-success').removeClass('text-danger');

      let password = $('#password').val();
      let confirm_password = $('#password_confirm').val();

      if (confirm_password === password && password.length >= 8) {
        $('.confirm-message').text("Hesla se shodují!").addClass('text-success');
      }
      else if (password.length >= 8) {
        $('.confirm-message').text("Hesla se neshodují!").addClass('text-danger');
      }
    });

    // call check function on any keyup
    $('input').on('keyup', function () {
      let password = $('#password').val();
      let confirm_password = $('#password_confirm').val();
      let email = $('#email').val();
      let email_regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      let email_valid = email_regex.test(email);
      if (password.length >= 8 && confirm_password === password && email_valid) {
        $('#regbtn').prop('disabled', false);
      } else {
        $('#regbtn').prop('disabled', true);
      }
    });

  </script>
</body>
</html>
<?php
  session_start();

  include "../mysql.php";

  if(!isset($_SESSION['admin'])){
    header("Location:../index.php");
    die();
  }

  if(isset($_POST['deleteUser'])) {
      $id = $_POST['deleteUser'];
      $sql = "DELETE FROM users WHERE id= '$id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      
      if($email == $_SESSION['email']) {
        session_destroy();
        header("Location:../index.php");
        die();
      }
      header("Location:uzivatele.php");
      die();
  }    
  if(isset($_POST['adminChange'])) {
      $id = $_POST['adminChange'];
      $state = $_POST['adminState'];
      $email = $_POST['email'];
      $state = $state == 1 ? 0 : 1;
      $sql = "UPDATE users SET is_admin = '$state' WHERE id = '$id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      if($email == $_SESSION['email']) {
        unset($_SESSION['admin']);
        header("Location:../index.php");
        die();
      }
      header("Location:uzivatele.php");
      die();
  }

  if(isset($_POST['changeClassOfUser'])) {
      $id = $_POST['changeClassOfUser'];
      $class_id = $_POST['class_id'];

      $sql = "UPDATE `users` SET `class_id` = '$class_id' WHERE `users`.`id` = '$id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:uzivatele.php");
      die();
  }

  if(isset($_POST['addClass'])) {
      $sql = "INSERT INTO classes (classname) VALUES ('')";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:tridy.php");
      die();
  }

  if(isset($_POST['renameClass'])) {
      $class_id = $_POST['class_id'];
      $newName = $_POST['renameClass'];
      $sql = "UPDATE classes SET classname = '$newName' WHERE class_id = '$class_id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:tridy.php");
      die();
  }

  if(isset($_POST['deleteClass'])) {
    $class_id = $_POST['deleteClass'];
    $sql = "DELETE FROM classes WHERE class_id = '$class_id'";
    $result = mysqli_query($connect, $sql);
    if(!$result) {
        $_SESSION['error'] = "Něco se nepovedlo!";
    }
    header("Location:tridy.php");
    die();
  }

  if(isset($_POST['newEmail'])) {
    $id = $_POST['userId'];
    $newEmail = $_POST['newEmail'];
    $sql = "UPDATE users SET email = '$newEmail' WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    if(!$result) {
        $_SESSION['error'] = "Něco se nepovedlo!";
    }
    header("Location:uzivatele.php");
    die();
  }

  if(isset($_POST['newName'])) {
    $id = $_POST['userId'];
    $newName = $_POST['newName'];
    $sql = "UPDATE users SET name = '$newName' WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    if(!$result) {
        $_SESSION['error'] = "Něco se nepovedlo!";
    }
    header("Location:uzivatele.php");
    die();
  }

  if(isset($_POST['newSurname'])) {
    $id = $_POST['userId'];
    $newSurname = $_POST['newSurname'];
    $sql = "UPDATE users SET surname = '$newSurname' WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    if(!$result) {
        $_SESSION['error'] = "Něco se nepovedlo!";
    }
    header("Location:uzivatele.php");
    die();
  }

  if(isset($_POST['addUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if($email == "" || $password == "" || $password_confirm == "") {
        $_SESSION['error'] = "Vyplňte povinná pole!";
        header("Location:pridatuzivatele.php");
        die();
    }
    if($password != $password_confirm) {
        $_SESSION['error'] = "Hesla se neshodují!";
        header("Location:pridatuzivatele.php");
        die();
    }
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Uživatel s tímto emailem již existuje!";
        header("Location:pridatuzivatele.php");
        die();
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : 1;
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $surname = isset($_POST['surname']) ? $_POST['surname'] : "";
    $is_admin = isset($_POST['is_admin']) ? $_POST['is_admin'] : 0;
    $sql = "INSERT INTO users (name, surname, email, pass, class_id, is_admin) VALUES ('$name', '$surname', '$email', '$password', '$class_id', '$is_admin')";
    $result = mysqli_query($connect, $sql);
    if(!$result) {
        $_SESSION['error'] = "Něco se nepovedlo!";
    }
    header("Location:uzivatele.php");
    die();
  }
 



?>

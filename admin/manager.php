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
      header("Location:studenti.php");
      die();
  }    
  if(isset($_POST['adminChange'])) {
      $id = $_POST['adminChange'];
      $state = $_POST['adminState'];
      $email = $_POST['email'];
      $state = $state == 1 ? 0 : 1;
      $sql = "UPDATE users SET admin = '$state' WHERE id = '$id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      if($email == $_SESSION['email']) {
        unset($_SESSION['admin']);
        header("Location:../index.php");
        die();
      }
      header("Location:studenti.php");
      die();
  }

  if(isset($_POST['renameClass'])) {
      $class_id = $_POST['class_id'];
      $newName = $_POST['newName'];
      $sql = "UPDATE classes SET name = '$newName' WHERE id = '$class_id'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:studenti.php");
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




?>

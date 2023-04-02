<?php
  session_start();

  include "../mysql.php";

  if(!isset($_SESSION['admin'])){
    header("Location:../index.php");
    die();
  }

  if(isset($_POST['delete'])) {
      $email = $_POST['delete'];
      $sql = "DELETE FROM users WHERE email = '$email'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      
      if($email == $_SESSION['email']) {
        unset($_SESSION['admin']);
        unset($_SESSION['email']);
        header("Location:../index.php");
        die();
      }
      header("Location:studenti.php");
      die();
  }    
  if(isset($_POST['adminChange'])) {
      $email = $_POST['adminChange'];
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($connect, $sql);
      $row = mysqli_fetch_assoc($result);  
      if($row['admin'] == true) {
          $sql = "UPDATE users SET admin = false WHERE email = '$email'";
      }
      else {
          $sql = "UPDATE users SET admin = true WHERE email = '$email'";
      }
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
      $class = $_POST['renameClass'];
      $newName = $_POST['newName'];
      $sql = "UPDATE classes SET name = '$newName' WHERE name = '$class'";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:studenti.php");
      die();
  }

?>

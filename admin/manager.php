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
      
      $sql = "INSERT INTO students (student_id, class_id) VALUES ('$id', '$class_id') ON DUPLICATE KEY UPDATE class_id = '$class_id';";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:uzivatele.php");
      die();
  }

  if(isset($_POST['addClass'])) {
      $name = $_POST['name'];
      $sql = "INSERT INTO classes (classname) VALUES ('$name')";
      $result = mysqli_query($connect, $sql);
      if(!$result) {
          $_SESSION['error'] = "Něco se nepovedlo!";
      }
      header("Location:tridy.php");
      die();
  }

  if(isset($_POST['renameClass'])) {
      $class_id = $_POST['class_id'];
      $newName = $_POST['newName'];
      $sql = "UPDATE classes SET classname = '$newName' WHERE id = '$class_id'";
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




?>

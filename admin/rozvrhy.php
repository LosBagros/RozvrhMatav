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
    <title>Rozvrhy | MatavRozvrh</title>
</head>
<body>
    <h1>Rozvrhy</h1>
        <?php
            include "../mysql.php";
            $sql = "SELECT * FROM classes";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            print_r($row);
        ?>
        
     <?php require("scripts.php") ?>

</body>
</html>
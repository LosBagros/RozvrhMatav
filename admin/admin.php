<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="costumblock">
        <h1 class="text-center m-3">Administrace</h1>
        <a class="btn btn-primary w-100 mt-3" href="tridy.php">Třídy</a>
        <a class="btn btn-primary w-100 mt-3" href="studenti.php">Studenti</a>
        <a class="btn btn-primary w-100 mt-3" href="ucitele.php">Učitelé</a>
        <form action="../server.php" method="POST">
            <button type="submit" class="btn btn-primary w-100 mt-3" name="logout" value="logout">Odhlásit se!</button>
        </form>
    </div>
</body>
</html>
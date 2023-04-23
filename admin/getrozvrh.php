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
    <title>Rozvrh | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="rozvrh text-center w-100">
    <h1 class="text-center m-3">Rozvrh</h1>
    <form action="getrozvrh.php" method="POST">
<?php
    require '../mysql.php';

    $class_id = $_POST['class_id'];
    $sql = "SELECT * FROM classes WHERE class_id = '$class_id'";
    $classes = mysqli_query($connect, $sql);
    if(!$classes) {
        $_SESSION['error'] = "Něco se nepovedlo!";
        header("Location:rozvrhy.php");
        die();
    }

    if($class_id == 1) {
        header("Location:rozvrhy.php");
        die();
    }
    $classes = mysqli_fetch_assoc($classes);
    $classname = $classes['classname'];
    echo '<h2 class="text-center m-3">' . $classname . '</h2>';


    $sql = "SELECT * FROM timetable WHERE class_id = '$class_id'";
    $timetable = mysqli_query($connect, $sql);
    if(!$timetable) {
        $_SESSION['error'] = "Něco se nepovedlo!";
        header("Location:rozvrhy.php");
        die();
    }
    $timetable = mysqli_fetch_assoc($timetable);

    $sql = "SELECT * FROM hours";
    $hours = mysqli_query($connect, $sql);
    if(!$hours) {
        $_SESSION['error'] = "Něco se nepovedlo!";
        header("Location:rozvrhy.php");
        die();
    }
    echo '<table class="table table-bordered w-75 mx-auto">';
    echo '<tr>';
    echo '<th></th>';
    foreach($hours as $hour) {
        echo '<th>' . $hour['start'] . ' - ' . $hour['end'] . '</th>';
    }
    echo '</table>';
?>

<a href="rozvrhy.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
<?php require("scripts.php") ?>
</body>
</html>
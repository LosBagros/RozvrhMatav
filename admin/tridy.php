<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Třídy | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="rozvrh text-center w-100">
        <table class="mx-auto">
            <tr>
                <th>Název Třídy</th>
                <th>Smazat</th>
            </tr>
            <?php
                require '../mysql.php';
                $sql = 'SELECT * FROM classes';
                $result = mysqli_query($connect, $sql);

                if($result) {
                    foreach($result as $row) {
                        echo '<tr>';
                        echo '<td><form action="manager.php" method="POST"><input type="text" name="renameClass" value="' . $row['classname'] . '"><input type="hidden" name="class_id" value="' . $row['class_id'] . '"></form></td>';
                        echo '<td><form action="manager.php" method="POST"><button type="submit" class="btn btn-danger" name="deleteClass" value="' . $row['class_id'] . '">Smazat</button></form></td>';
                        
                    }
                }
            ?>
        </table>
        <form action="manager.php" method="POST"><input type="hidden" name="addClass"><button class="btn btn-success w-100 mt-3">Přidat třídu</button><br>
        <a href="admin.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
    </div>
    <?php require("scripts.php") ?>
</body>
</html>
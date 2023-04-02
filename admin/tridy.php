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
    <title>Třídy | Admin | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="rozvrh text-center w-100">
        <table class="mx-auto">
            <tr>
                <th>Název Třídy</th>
                <th>Upravit</th>
                <th>Smazat</th>
            </tr>
            <?php
                require '../mysql.php';
                $sql = 'SELECT * FROM classes';
                $result = mysqli_query($connect, $sql);

                if($result) {
                    foreach($result as $row) {
                        echo '<tr>';
                        echo '<td><form action="usermanager.php" method="POST"><input type="text" name="newName" value="' . $row['name'] . '"><button type="submit" class="btn btn-primary" name="renameClass" value="' . $row['id'] . '">Upravit</button></form></td>';

                        
                    }
                }
            ?>
        </table>
        <a href="admin.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
    </div>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script>
        // add class border border-info to all children of .rozvrh
        $("table").children().children().children().addClass("border border-info p-3");
        $("table").children().children().addClass("border border-info");
        function changeAdmin(id) {
            document.getElementById("admin" + id).submit();
        }

    </script>
    <script src="../js/theme.js"></script>
</body>
</html>
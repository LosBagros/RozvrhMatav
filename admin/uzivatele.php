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
    <title>Studenti | MatavRozvrh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="rozvrh text-center w-100">
        <table class="mx-auto">
            <tr>
                <th>Email</th>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Třída</th>
                <th>Admin</th>
                <th>Smazat</th>
            </tr>
            <?php
                require '../mysql.php';
                $sql = 'SELECT * FROM classes;';
                $classes_res = mysqli_query($connect, $sql);
                if($classes_res) {
                    $classes = $classes_res->fetch_all(MYSQLI_ASSOC);
                }
                $sql = 'SELECT * FROM users ORDER BY `users`.`is_admin` DESC';
                $result = mysqli_query($connect, $sql);

                if($result && $classes_res) {
                    foreach($result as $row) {
                        echo '<tr>';
                        echo '<td><form action="manager.php" method="POST"><input type="email" name="newEmail" value="' . $row['email'] . '"><input type="hidden" name="userId" value="' . $row['id'] . '"></form></td>';
                        echo '<td><form action="manager.php" method="POST"><input type="text" name="newName" value="' . $row['name'] . '"><input type="hidden" name="userId" value="' . $row['id'] . '"></form></td>';
                        echo '<td><form action="manager.php" method="POST"><input type="text" name="newSurname" value="' . $row['surname'] . '"><input type="hidden" name="userId" value="' . $row['id'] . '"></form></td>';
                        echo '<td><form action="manager.php" method="POST" id="changeClass' . $row['id'] . '">';
                        echo '<select name="class_id" class="form-select" onchange="changeClass('. $row['id'] . ')">';
                        foreach($classes as $class) {
                            $selected = $class['class_id'] == $row['class_id'] ? "selected" : "";
                            echo '<option value="' . $class['class_id'] . '" ' . $selected . '>' . $class['classname'] . '</option>';
                        }
                        echo '</select><input type="hidden" name="changeClassOfUser" value="' . $row['id'] . '"></form></td>';
                        $isAdmin = $row['is_admin'] == 1 ? "checked" : ""; 
                        echo '<td><form action="manager.php" method="POST" id="admin' . $row['id'] . '"><input type="checkbox" onchange="changeAdmin(' . $row['id'] . ')"'. $isAdmin . '><input type="hidden" name="adminChange" value="' . $row['id'] . '"><input type="hidden" name="adminState" value="' . $row['is_admin'] . '"><input type="hidden" name="email" value="' . $row['email'] . '"></form></td>';
                        echo '<td><form action="manager.php" method="POST"><button type="submit" class="btn btn-danger" name="deleteUser" value="' . $row['id'] . '">Smazat</button></form></td>';
                        echo '</tr>';
                    }
                }
            ?>
        </table>
        <!-- add button for adding new user -->
        <a href="pridatuzivatele.php" class="btn btn-success w-100 mt-3">Přidat uživatele</a><br>
        <a href="admin.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
    </div>
    <script>
        // add class border border-info to all children of .rozvrh
        
        function changeAdmin(id) {
            document.getElementById("admin" + id).submit();
        }
        function changeClass(id) {
            document.getElementById("changeClass" + id).submit();
        }
        
        </script>
    <?php require("scripts.php") ?>

</body>
</html>
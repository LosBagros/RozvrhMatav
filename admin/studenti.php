<?php
  session_start();
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
    <div class="rozvrh text-center w-100">
        <table class="mx-auto">
            <tr>
                <th>Email</th>
                <th>Třída</th>
                <th>Admin</th>
                <th></th>
            </tr>
            <?php
            require '../mysql.php';
            $sql = 'SELECT * FROM users';
            $result = mysqli_query($connect, $sql);

            if($result) {
                foreach($result as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['class_id'] . '</td>';
                    $isAdmin = $row['admin'] == 1 ? "checked" : ""; 
                    echo '<td><form action="usermanager.php" method="POST" id="admin' . $row['id'] . '"><input type="checkbox" onchange="changeAdmin(' . $row['id'] . ')"'. $isAdmin . '><input type="hidden" name="adminChange" value="' . $row['email'] . '"></form></td>';
                    echo '<td><form action="usermanager.php" method="POST"><button type="submit" class="btn btn-danger" name="delete" value="' . $row['email'] . '">Smazat</button></form></td>';
                    echo '</tr>';
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
</body>
</html>
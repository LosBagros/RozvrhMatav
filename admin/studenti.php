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
            </tr>
            <?php
            require '../mysql.php';
            $sql = "SELECT * FROM users";
            $result = mysqli_query($connect, $sql);

            if($result) {
                // foreach php
                foreach($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . "</td>";
                    $isAdmin = $row['admin'] == 1 ? "checked" : ""; 
                    echo '<td><input type="checkbox" value="' . $row['email'] . '"'. $isAdmin . "></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

    </div>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script>
    // add class border border-info to all children of .rozvrh
    $("table").children().children().children().addClass("border border-info p-3");
    $("table").children().children().addClass("border border-info");
    $("checkbox").click(function() {
        
    });
</script>
</body>
</html>
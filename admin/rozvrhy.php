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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="rozvrh text-center w-100">
    <h1 class="text-center m-3">Rozvrh</h1>
    <form action="getrozvrh.php" method="POST">
    <select class="form-select w-25 mx-auto" id="class" name="class_id" onchange="changeClass()">
        <?php
            require '../mysql.php';
            $sql = 'SELECT * FROM classes';
            $result = mysqli_query($connect, $sql);

            if($result) {
                foreach($result as $row) {
                    echo '<option value="' . $row['class_id'] . '">' . $row['classname'] . '</option>';
                }
            }
        ?>
    </select>
    <!-- on change load table of class -->
    </form>
</div>
     <?php require("scripts.php") ?>
     <script>
         function changeClass() {
            $("form").submit();
         }
     </script>

</body>
</html>
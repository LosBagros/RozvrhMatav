<?php
    session_start();
    include "mysql.php";

    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Tento uživatel už existuje!";
            header("Location:registrace.php");
            die();
        }
        
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        if ($password != $password_confirm) {
            $_SESSION['error'] = "Hesla se neshodují!";
            header("Location:registrace.php");
            die();
        }
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, pass) VALUES ('$email', '$password')";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            $_SESSION['error'] = "Něco se nepovedlo!";
            header("Location:registrace.php");
            die();
        }
        $_SESSION['email'] = $email;
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['pass'])) {
                $_SESSION['email'] = $email;
                if($row['admin'] == 1) {
                    $_SESSION['admin'] = true;
                    header("Location:admin/admin.php");
                    die();
                }
            } else {
                $_SESSION['error'] = "Nesprávné heslo!";
                header("Location:login.php");
                die();
            }
        } else {
            $_SESSION['error'] = "Uživatel neexistuje!";
            header("Location:login.php");
            die();
        }
    }

    mysqli_close($connect);

    if(isset($_POST["logout"]));
    {
        session_destroy();
    }

    header("Location:index.php");
    die();
?>
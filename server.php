<?php
    session_start();
    echo "server.php";

    # echo post data
    #echo "<pre>";
    #print_r($_POST);
    #echo "</pre>";
    #die();

    $envFile = __DIR__ . '/.env';
    if (file_exists($envFile)) {
        $env = parse_ini_file($envFile);
        $dbHostname = $env['DB_HOSTNAME'];
        $dbUsername = $env['DB_USER'];
        $dbPassword = $env['PASSWORD'];
        $dbName = $env['DATABASE'];
    }

    $connect = mysqli_connect($dbHostname, $dbUsername, $dbPassword, $dbName);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['register'])) {
        echo "register";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        if ($password != $password_confirm) {
            echo "Passwords do not match!";
            die();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, pass) VALUES ('$email', '$password')";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "You have registered successfully!";
        } else {
            echo "There was a problem registering you!";
        }
    }

    if (isset($_POST['login'])) {
        echo "login";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['pass'])) {
                $_SESSION['email'] = $email;
                echo "You have logged in successfully!";
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User does not exist!";
        }
    }

    mysqli_close($connect);

    if(isset($_POST["logout"]))
    {
        session_destroy();
    }

    header("Location:index.php");
    die();
?>
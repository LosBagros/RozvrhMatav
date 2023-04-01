<?php
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
?>
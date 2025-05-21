<?php
    $host = 'db';
    $dbname = 'Kartodromo';
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port); // MySQLI è una classe che si occupa di creare una connessione con il database

    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
    }
?>
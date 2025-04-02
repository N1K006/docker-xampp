<?php

//Presi dal docker.compose.yml
$host = 'db';
$dbname = 'root_db';
$user = 'user';
$password = 'user';
$port = 3306;

try {
    $dsn = 'mysql:host=$host;dbname=$dbname;user=$user;password=$password;port=$port;';
    $pdo = new PDO($dsn, $user, $passord);

    pdo->setAttribute(PDO::ATTR_RRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connessione al database riuscita con PDO!";
} catch (PDOException $e) {
    echo "Errore durante la connessione al database: ".$e->getMessage();
}
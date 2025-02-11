<?php
// Presi dal docker-compose.yml
$host = 'db';
$dbname = 'root_db';
$user = 'user';
$password = 'user';
$port = 3306;

// Suggested code may be subject to a license. Learn more: ~LicenseLog:2891145126.
$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "Connessione al database riuscita con mysqli";
$connection->close();
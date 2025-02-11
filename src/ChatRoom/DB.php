<?php
// Presi dal docker-compose.yml
$host = 'db';
$dbname = 'DB_ChatRoom';
$user = 'user';
$password = 'user';
$port = 3306;

// Suggested code may be subject to a license. Learn more: ~LicenseLog:2891145126.
$connection = new mysqli($host, $user, $password, $dbname, $port); // MySQLI è una classe che si occupa di creare una connessione con il database

if ($connection->connect_error) 
{
    die("Connection failed: " . $connection->connect_error); // Serve a "uccidere"/interrompere l'esecuzione dello script engine
}
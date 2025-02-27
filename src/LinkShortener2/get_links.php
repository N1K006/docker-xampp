<?php
session_start();
require_once "db.php";

$id_utente = $_SESSION["id_utente"];

$query = "SELECT * FROM links WHERE id_utente = '$id_utente'";
$result = $connection->query($query);

$messages = [];

if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) 
    {
        $messages[] = $row;
    }
}

// Invia i messaggi come JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
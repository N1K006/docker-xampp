<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $original_link = $_POST['original_link'];
    $id_utente = $_SESSION["id_utente"];
    
    $query = "INSERT INTO links (original_link, id_utente) VALUES ('$original_link', '$id_utente')";
    $result = $connection->query($query);
    
    if (!$result)
    {
        echo ("Errore nell'inserimento del link nel db");
    }
}
else
{
    die("sei lucio?");
}
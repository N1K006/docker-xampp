<?php
/* API: Application Programming Interface (Interfaccia di Programmazione delle Applicazioni) è un insieme di 
operazioni o funzioni che un programmatore può utilizzare per interagire con un'applicazione o un servizio esterno*/
session_start();
require_once "../includes/db.php";

header('Content-Type: application/json');

$query = "SELECT * FROM users";
$result = $connection->query($query);

$data = [];
if ($result)
{
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $data[] = $row;
        }
    }
}

// Invia i messaggi come JSON
echo json_encode($data);
?>
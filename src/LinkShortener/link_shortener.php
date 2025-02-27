<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";

$original_link = $_POST['original_link'];
$id_utente = $_SESSION["id_utente"];

$query = "INSERT INTO links (original_link, id_utente) VALUES ('$original_link', '$id_utente')";
$result = $connection->query($query);

if ($result)
{
    $link_id = $connection->insert_id;
    $shorted_link = "https://3000-idx-docker-xampp-1736234920290.cluster-y34ecccqenfhcuavp7vbnxv7zk.cloudworkstations.dev/LinkShortener/redirect.php?link_id=$link_id";
}
else
{
    echo ("Errore nell'inserimento del link nel db");
}
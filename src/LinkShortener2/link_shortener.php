<?php
session_start();
require_once "db.php";

$original_link = $_POST['original_link'];
$id_utente = $_SESSION["id_utente"];

// Genera un hash del link
$link_hash = md5($original_link . $id_utente);

// Controlla se il link esiste già
$query = "SELECT id_link FROM links WHERE original_link = '$original_link' AND id_utente = '$id_utente'";
$result = $connection->query($query);

if ($result->num_rows == 0) {
    // Se il link non esiste, lo inserisce nel database
    $query = "INSERT INTO links (original_link, id_utente) VALUES ('$original_link', '$id_utente')";
    $connection->query($query);

    // Crea il file PHP per il redirect
    $directory = "short_links/";
    if (!is_dir($directory)) 
        mkdir($directory, 0755, true);

    $filePath = $directory . $link_hash . ".php";
    file_put_contents($filePath, "<?php header('Location: $original_link'); exit; ?>");
}

// Link accorciato
echo "https://3000-idx-docker-xampp-1736234920290.cluster-y34ecccqenfhcuavp7vbnxv7zk.cloudworkstations.dev/LinkShortener2/" . $link_hash . ".php";
?>
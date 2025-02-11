<?php
session_start(); // Avvia la sessione
include "DB.php"; // Connessione al database
ob_start();  // Inizia il buffer di output
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elenco Stanze</title>
        <link rel="stylesheet" type="text/css" href="Stile.css">
    </head>
</html>

<?php

// Verifica se è presente l'ID stanza nel parametro GET
if (isset($_GET['id_stanza'])) 
{
    $_SESSION["id_stanza"] = $_GET['id_stanza'];
}

// Visualizza elenco stanze se non si sta creando una nuova stanza
if (!isset($_POST['action']) || $_POST['action'] != 'new_room') 
{
    $query = "SELECT id_stanza, nome_stanza, descrizione_stanza FROM stanze ORDER BY id_stanza DESC";
    $result = $connection->query($query);
    
    // Verifica se ci sono stanze nel database
    if ($result && $result->num_rows > 0) 
    {
        echo "<h1>Elenco delle stanze: </h1> <br>";

        // Cicla su ogni stanza e mostra le informazioni
        while ($row = $result->fetch_assoc()) 
        {
            echo "<div class='room'>
                <a href='room.php?id_stanza=" . $row['id_stanza'] . "' class='room-name'>" . $row['nome_stanza'] . "</a>
                <p>" . $row['descrizione_stanza'] . "</p>
            </div> <br>";
        }
    } 
    else 
    {
        echo "<h2> Nessuna stanza disponibile.</h2>";
    }
} 
else 
{
    // Creazione di una nuova stanza
    $nome_stanza = $_POST['nome_stanza'];
    $descrizione_stanza = $_POST['descrizione_stanza'];

    // Verifica se la stanza già esiste
    $query = "SELECT * FROM stanze WHERE nome_stanza='$nome_stanza' AND descrizione_stanza='$descrizione_stanza'";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) 
    {
        echo "Stanza già esistente, cambia i dati";
    } 
    else 
    {
        $query = "INSERT INTO stanze (nome_stanza, descrizione_stanza) VALUES ('$nome_stanza', '$descrizione_stanza')";
        $result = $connection->query($query);

        if ($result) 
        {
            header("Location: rooms.php");
            exit;
        } 
        else 
        {
            echo "Errore durante la creazione della stanza.";
        }
    }
}
?>

<!-- Contenitore per i bottoni -->
<div class="bottoni">
    <form action="new_room.php" method="GET">
        <button type="submit" name="action" value="create_room">Crea Nuova Stanza</button>
    </form>

    <form action="Accedi.html" method="GET">
        <button type="submit">Torna alla pagina di Login</button>
    </form>
</div>
<?php
session_start(); // Avvia la sessione
ob_start();  // Inizia il buffer di output
include "DB.php"; // Connessione al database
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elenco Stanze</title>
        <!-- Collegamento al file CSS -->
        <link rel="stylesheet" type="text/css" href="Stile.css">
    </head>
</html>

<?php
// Se l'utente seleziona una stanza, salva l'ID nella sessione
if (isset($_GET['id_stanza'])) 
{
    $_SESSION["id_stanza"] = $_GET['id_stanza'];
}
// Controlla se l'ID stanza è presente nella sessione
if (!isset($_SESSION["id_stanza"])) 
{
    echo "Nessuna stanza selezionata.";
    exit;
}
$id_stanza = $_SESSION["id_stanza"];

if (!isset($_POST['action']) || $_POST['action'] != 'new_message')
{
    if ($_SESSION["id_stanza"] || isset($_GET['id_stanza'])) 
    {
        // Query per ottenere i dettagli della stanza
        $query = "SELECT nome_stanza, descrizione_stanza FROM stanze WHERE id_stanza = '$id_stanza'";
        $result = $connection->query($query);
    
        if ($result && $result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            // Mostra i dettagli della stanza
            echo "<h1>" . $row['nome_stanza'] . "</h1>";
            echo "<p>" . $row['descrizione_stanza'] . "</p> <br>";
    
            $query = "SELECT u.username, id_messaggio, id_stanza, m.id_utente, m.testo, orario FROM messaggi m JOIN utenti u ON m.id_utente = u.id_utente WHERE m.id_stanza = '$id_stanza' ORDER BY m.orario DESC";
            $result = $connection->query($query);
        
            if ($result && $result->num_rows > 0) 
            {
                echo "<h2>Elenco messaggi:</h2>";

                while ($row = $result->fetch_assoc()) 
                {
                    echo "<div class='room'>
                            <p><strong>" . $row['username'] . ":</strong> " . $row['testo'] . " <em>(" . $row['orario'] . ")</em></p>
                          </div>";
                }
            } 
            else 
                echo "<strong> <p>Nessun messaggio presente per questa stanza.</p> </strong> <br>";
        }
        else 
            echo "Stanza non trovata.";
    } 
    else 
        echo "ID stanza non specificato.";
}
else 
{
    // Recupera id_utente dalla sessione, se presente
    if (isset($_SESSION["id_utente"])) 
    {
        $id_utente = $_SESSION["id_utente"];

        $query = "SELECT * FROM utenti WHERE id_utente = '$id_utente'";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) 
        {
            if (!empty($_POST['testo']))
            {
                $testo = $_POST['testo'];
    
                $query = "INSERT INTO messaggi (id_stanza, id_utente, testo, orario) VALUES ('$id_stanza', '$id_utente', '$testo', NOW())";
                $result = $connection->query($query);
    
                if (!$result) 
                {
                    echo "Errore durante l'invio del messaggio.";
                }
                else
                {
                    header("Location: room.php");
                    exit;
                }
            }
            else
                echo "Nessun messaggio inserito";
        }
    }
    else
    {
        echo "Utente non autenticato";
        exit;  // Interrompe l'esecuzione se l'utente non è autenticato
    }
}
?>

<!-- Form per inviare messaggi -->
<div class="bottoni">
    <form action="room.php" method="post">
        <input type="text" name="testo" required placeholder="Scrivi il tuo messaggio...">
        <button type="submit" name="action" value="new_message">Invia messaggio</button><br><br>
    </form>

    <!-- Link per tornare alla lista delle stanze -->
    <form action="rooms.php" method="GET">
        <button type="submit">Torna alla lista di stanze</button>
    </form>
</div>
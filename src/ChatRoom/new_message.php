<?php
session_start(); // Avvia la sessione
include "DB.php"; // Connessione al database
?>

<html>
    <form method='post' action='room.php'>
    <h1>Scrivi un messaggio</h1>
    Messaggio: <input type='text' name='testo' required placeholder="Scrivi il tuo messaggio..."><br><br>

    <button type='submit' name='action' value='new_message'>Invia messaggio</button>
    </form>

    <p> Vuoi tornare alla pagina principale? <a href="rooms.php">Annulla</a></p>

</html>
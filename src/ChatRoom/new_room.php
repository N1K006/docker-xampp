<?php
session_start(); // Avvia la sessione
include "DB.php"; // Connessione al database
?>


<html>
    <form method='post' action='rooms.php'>
    <h1>Crea stanza</h1>
    Nome della stanza: <input type='text' name='nome_stanza' required><br><br>
    Descrizione della stanza: <input type='text' name='descrizione_stanza' required><br><br>

    <button type='submit' name='action' value='new_room'>Crea nuova stanza</button>
    </form>

    <p> Vuoi tornare alla pagina principale? <a href="rooms.php">Annulla creazione</a></p>

</html>
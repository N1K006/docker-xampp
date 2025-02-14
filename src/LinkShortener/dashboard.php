<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabella link</title>
        <link rel="stylesheet" href="stile.css">
    </head>

    <body>
        <header style = "background-color: blue;">
            <h1>Dashboard di link</h1>
        </header>

        <div class="container">
            <div>link</div>
            <div>link short</div>
            <div>description</div>
        </div>


</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $action = $_POST['action'];
    $original_link = $_POST['link'];

    if ($_POST['action'] != 'update_link')
    {
        $query = "SELECT id_link, original_link, id_utente, link_short, description FROM links";
        $result = $connection->query($query);
        
        if ($result && $result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<div class='container'>";
                echo "<div>" . $row['original_link'] . "</div>";
                echo "<div>" . $row['link_short'] . "</div>";
                echo "<div>" . $row['description'] . "</div>";
            }
        }
    }
    else
    {
        if (!empty($original_link))
        {
            
        }

        $link_short = $_POST['link_short'];
        $description = $_POST['description'];

        $query = "INSERT INTO links (original_link, link_short, description) VALUES ('$original_link', '$link_short', '$description')";
        $result = $connection->query($query);

        if ($result)
        {
            echo "Link inserito nel db"
        }
        else
            echo "Errore nell'inserimento del link nel db"
    }
}
?>

<!-- Form per inviare messaggi -->
<div class="bottoni">
    <form action="link_shortener.php" method="post">
        <input type="text" name="link" required placeholder="Inserisci il tuo link...">
        <button type="submit" name="action" value="update_link">Invia</button><br><br>
    </form>
</div>
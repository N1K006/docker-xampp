<?php
ob_start();
session_start();
require_once("db/db.php");

if (isset($_SESSION["codice_fiscale"]) && $_SESSION["ruolo"] == 0)
{
    echo "<h1>Benvenuto, " . $_SESSION['codice_fiscale'] . "</h1><br><br>";

    $result = $connection->query("SELECT * FROM gara ORDER BY data_gara DESC");

    if ($result && $result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            echo "<form method='get' action='gara.php'>
                  <input type='hidden' name='id' value='" . $row['id_gara'] . "'>
                  <button type=submit name='action' value='gara'>Gara del giorno: " . $row['data_gara'] . " - Num. Gara: " . $row["id_gara"] . "</button>
                  </form>";
        }
    }
    else
        echo "Nessuna gara disponibile";
}
else 
{
    header("Location: login.php");
    exit;   
}
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard gare</title>
    </head>
</html>
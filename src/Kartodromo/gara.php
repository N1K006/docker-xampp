<?php
ob_start();
session_start();
require_once("db/db.php");
$cookie_name = 'gara';

if (isset($_SESSION["codice_fiscale"]) && $_SESSION["ruolo"] == 0)
{
    if (isset($_GET['id']))
    {
        $id_gara = $_GET["id"];
        setcookie($cookie_name, $id_gara, time() + 5000);
    }
    else if (isset($_COOKIE[$cookie_name]))
        $id_gara = $_COOKIE[$cookie_name];
    else
    {
        header("Location: dashboard_gare.php");
        exit;
    }

    $result = $connection->query("SELECT data_gara FROM gara WHERE id_gara='$id_gara'");
    if ($result)
    {
        $row = $result->fetch_assoc();
        $data_gara = $row['data_gara'];

        echo "<h1>Gara del giorno, " . $data_gara . "</h1><br><br>";
        
        $result = $connection->query("SELECT * FROM partecipazione WHERE id_gara='$id_gara' ORDER BY posizione");
        if ($result && $result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "Giocatore con cod_f: " . $row['cod_f'] . ", arrivato al " . $row['posizione'] . "° posto con il kart: " . $row['num_kart'] . "<br><br>";
            }
        }
        else
            echo "Nessun giocatore trovato";
    }
    else
        echo "Nessuna gara trovata";
    return;
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
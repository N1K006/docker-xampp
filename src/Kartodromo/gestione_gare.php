<?php
ob_start();
session_start();
require_once("db/db.php");

if ($_SESSION["ruolo"] == 0 || !isset($_SESSION["cod_f"]))
{
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "Invia" && isset($_FILES["file"]["tmp_name"]) && isset($_POST["id_gara"]) && isset($_POST["data_gara"]))
{
    $id_gara = $_POST["id_gara"];
    $data_gara = $_POST["data_gara"];
    $contenuto_file = file_get_contents($_FILES["file"]["tmp_name"]);
    $array = explode("\n", trim($contenuto_file));

    $result = $connection->query("INSERT INTO gara (id_gara, data_gara) VALUES ('$id_gara', '$data_gara')");

    if ($result)
    {
        foreach ($array as $row)
        {
            $array = explode(",", $row);
            $cod_f = $array[0];
            $num_kart = (int)$array[1];
            $posizione = (int)$array[2];
            
            $result = $connection->query("INSERT INTO partecipazione (id_gara, cod_f, num_kart, posizione) VALUES ('$id_gara', '$cod_f', '$num_kart', '$posizione')");
        }
    }
    else
    {
        echo "Errore: $connection->error";
        exit;
    }
}
?>
<html>
    <form method="post" action="gestione_gare.php" enctype="multipart/form-data">
        File: <input type="file" name="file"><br>
        Gara: <input type="text" name="id_gara"><br>
        Data gara: <input type="date" name="data_gara">
        <button type="submit" name='action' value="Invia">Invia</button>
    </form>
</html>
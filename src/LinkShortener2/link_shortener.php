<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $original_link = $_POST["original_link"];
    $id_utente = $_SESSION["id_utente"];

    $hash = substr(hash("crc32", $original_link), 0, 8);
    $shorted_link = "https://3000-idx-docker-xampp-1736234920290.cluster-y34ecccqenfhcuavp7vbnxv7zk.cloudworkstations.dev/LinkShortener2/links/$hash";

    $query = "INSERT INTO links (original_link, shorted_link, id_utente) VALUES ('$original_link', '$shorted_link', '$id_utente')";
    $result = $connection->query($query);

    if (!$result)
        die("Errore nell'inserimento del link nel db");

    $code =
            "<?php
            session_start();
            ob_start();  // Inizia il buffer di output
            require_once \"../db.php\";

            if (\$_SERVER[\"REQUEST_METHOD\"] == \"GET\")
            {
                \$query = \"UPDATE links SET n_visite = n_visite + 1 WHERE original_link = '$original_link'\";
                \$result = \$connection->query(\$query);

                if (!\$result)
                    die(\"Errore nell'aggiornare il numero di visite\");

                header(\"Location: $original_link\");
                exit;
            }
            ?>";

    file_put_contents("links/$hash", $code);
    echo "success";
}
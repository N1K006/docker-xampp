<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $link_id = $_GET["link_id"];

    $query = "SELECT * FROM links WHERE id_link = '$link_id'";
    $result = $connection->query($query);

    if ($result)
        if ($result->num_rows > 0)
            if ($row = $result->fetch_assoc())
            {
                $visite = $row['n_visite'];
                $visite += 1;
                $update_query = "UPDATE links SET n_visite = '$visite' WHERE id_link = '$link_id'";
                $connection->query($update_query);

                header("Location: " . $row['original_link']);
                exit;
            }
}
?>
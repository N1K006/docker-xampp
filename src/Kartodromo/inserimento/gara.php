<?php
ob_start();
session_start();
require_once("../db/db.php");

$i = 1;
while ($i < 20)
{
    $query = "insert into gara (data_gara) value ('2025-05-$i')";
    $connection->query($query);
    $i++;
}
?>
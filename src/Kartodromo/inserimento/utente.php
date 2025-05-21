<?php
ob_start();
session_start();
require_once("../db/db.php");

$i = 0;
while ($i < 20)
{
    $query = "insert into utente (cod_f, pwd) value ($i, $i)";
    $connection->query($query);
    $i++;
}
?>
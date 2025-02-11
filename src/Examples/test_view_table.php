<?php
require_once '../includes/db.php'; // è come prendere il codice presente in db.php e incollarlo qua 

$table = "users";
$query = "SELECT * FROM $table";
$result = $connection->query($query); // la potrò usare per esempio per eseguire le query

// dual interface --> puo essere sia procedurale e sia orientata agli oggetti
// oggetti --> verrà utilizzata piu volte e verrà sempre supportata

if ($result->num_rows > 0)
{
    echo "<table>";

    while ($column = $result->fetch_field())
    {
        var_dump($column);
        echo "<th>";
        echo $colum->name;
        echo "</th>";
    }

    // stampo il contenuto della tabella
    while($row = $result->fetch_ass())
    {
        echo "<tr>";

        foreach ($row as $key=>$value)
        {
            echo "<td> $value </td";
        }
        echo "</tr>";
    }
    echo "</table>";
}


/*$table_name = 'users';

$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

//testa il numero di righe ritornate dalla query
if ($result->num_rows > 0)
{
    echo "<table>";
    echo "<tr>";

    //stampa i nomi delle colonneù
    $
}*/
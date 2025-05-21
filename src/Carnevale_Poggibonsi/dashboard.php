<?php
session_start();
ob_start();
include("db.php");

// Verifica se l'utente è autenticato
if (!isset($_SESSION["codice_fiscale"])) 
{
    header("Location: login.php"); // Redirige alla pagina di login se non è autenticato
    exit;
}
?>

<html>
<body>
    <h1>Dashboard Maschere</h1>
</body>
</html>

<?php
echo "Benvenuto, " . $_SESSION['codice_fiscale'] . "<br><br>";

$query = "SELECT * FROM maschere ORDER BY id_maschera";
$result = $connection->query($query);

if ($result)
{
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            /*echo "<form method='get' action='maschera.php'>
                  <input type='hidden' name='nome' value='" . $row['nome'] . "'>
                  <input type='hidden' name='id' value='" . $row['id_maschera'] . "'>
                  <button type=submit name='action' value='maschera'>Nome maschera: " . $row['nome'] . "</button>
                  </form>";*/

            echo "<form method='get' action='maschera.php' style='display: inline;'>
                <input type='hidden' name='nome' value='" . $row['nome'] . "'>
                <input type='hidden' name='id' value='" . $row['id_maschera'] . "'>
                Nome maschera: <strong>" . $row['nome'] . "</strong>
                <button type='submit' name='action' value='maschera'>Seleziona</button>
                </form><br><br>"; 

            /*echo "<div>
                  <a href=maschera.php?nome=" . $row['nome'] . ">Nome maschera: " . $row['nome'] . "</a>
                  </div><br>";*/

        }
    }
    else
        echo "Nessuna maschera disponibile";
}
else
echo "Errore: "  . $connection->error;
?>
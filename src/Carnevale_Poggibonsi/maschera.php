<?php
session_start();
ob_start();
include("db.php");

if (isset($_GET['action']) && $_GET['action'] == 'maschera')
{
    if (isset($_GET['nome']))
    {
        $nome_maschera = $_GET['nome'];
        $_SESSION['nome_maschera'] = $nome_maschera;
    }
    if (isset($_GET['id']))
    {
        $id_maschera = $_GET['id'];
        $_SESSION['id_maschera'] = $id_maschera;
    }
}
?>

<html>
<body>
    <h1>Maschera selezionata: <?php if (isset($_GET['action']) && $_GET['action'] == 'maschera') echo $_GET['nome']; ?> </h1>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'set_mask')
{
    $id_maschera = $_POST['id_maschera'];
    $cod_f = $_SESSION['codice_fiscale'];

    $query = "SELECT id_maschera FROM utenti WHERE c_f='$cod_f'";
    $r=$connection->query($query);

    if ($r)
    {
        if ($row = $r->fetch_assoc())
        {
            if ($id_maschera == $row['id_maschera'])
            {
                echo "Maschera già scelta";
            }
            else
            {
                $query = "UPDATE utenti SET id_maschera='$id_maschera' WHERE c_f='$cod_f'";
                $result = $connection->query($query);

                if ($result)
                {
                    echo "Maschera scelta con successo!";

                    echo "<form method='get' action='maschera.php'>
                        <button type='submit' name='action' value='back'>Ok, torna indietro</button>
                        </form>";
                }
                else
                {
                    echo "Errore: $connection->error";
                }
            }
        }
        else
        {
            echo "Errore: $connection->error";
        }
    }
}
else
{
    if (isset($_SESSION['id_maschera']))
    {
        $id_maschera = $_SESSION['id_maschera'];

        $query = "SELECT COUNT(c_f) as num_utenti FROM utenti WHERE id_maschera='$id_maschera'";
        $result = $connection->query($query);

        if ($result)
        {
            if ($row = $result->fetch_assoc())
            {
                echo "Utenti che usano questa maschera: " . $row['num_utenti'] . "<br>"; 
                echo "Clicca conferma per scegliere questa maschera";

                if ($row['num_utenti'] < 50)
                {
                    echo "<form method='post' action='maschera.php'>
                        <input type='hidden' name='id_maschera' value='" . $id_maschera . "'>
                        <button type='submit' name='action' value='set_mask'>Conferma</button>
                        </form>";

                    echo "<form action='dashboard.php'>
                        <button type='submit' name='action' value='dashboard'>Indietro</button>
                        </form>";
                }
                else
                {
                    echo "Questa maschera è stata scelta da troppi utenti, scegline un'altra!";
                }
            }
            else
                echo "Nessuna maschera seleziionata";
        }
        else
            echo "Errore: $connection->error";
    }
}
?>
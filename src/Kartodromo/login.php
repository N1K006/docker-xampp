<?php
ob_start();
session_start();
require_once("db/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "login" && isset($_POST["codice_fiscale"]) && isset($_POST["password"]))
{
    $cod_f = $_POST['codice_fiscale'];
    $pwd = $_POST['password'];

    $result = $connection->query("SELECT * FROM utente WHERE cod_f='$cod_f' AND pwd='$pwd'");

    if ($result && $result->num_rows > 0)
    {
        if ($row = $result->fetch_assoc())
        {
            $_SESSION["codice_fiscale"] = $cod_f;
            $_SESSION["pwd"] = $pwd;
            $_SESSION["ruolo"] = $row["ruolo"];

            if ($_SESSION["ruolo"] == 0) // 0 --> cliente
            {
                header("Location: dashboard_gare.php");
                exit;
            }
            else // 1 -->  gestore
            {
                header("Location: gestione_gare.php");
                exit;
            }
        }
        echo "Credenziali errate";
    }
    else
        die("Errore: $connection->error");
}
echo "<link rel=\"stylesheet\" href=\"style.css\">

        <form method=\"post\" action=\"login.php\">
            Codice fiscale: <input type=\"text\" name=\"codice_fiscale\" required><br><br>
            Password: <input type=\"password\" name=\"password\" required><br><br>
          
            <button type=\"submit\" name='action' value=\"login\">Accedi</button>
        </form>
    
        <form method=\"get\" action=\"registration.php\">
            <button type=\"submit\" name='action' value=\"register\">Registrati</button>
        </form>";
?>
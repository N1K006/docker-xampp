<?php
session_start();
ob_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    if (isset($_POST['action']) && $_POST['action'] == 'login')
    {
        $cod_f = $_POST['codice_fiscale'];
        $pwd = $_POST['password'];
    
        $query = "SELECT * FROM utenti WHERE c_f='$cod_f' AND pwd='$pwd'";
        $result = $connection->query($query);

        if ($result)
        {
            if ($row = $result->fetch_assoc())
            {
                $_SESSION["codice_fiscale"] = $cod_f;
                $_SESSION["pwd"] = $pwd;

                header("Location: dashboard.php");
                exit;
            }
            else
            {
                echo "Credenziali errate";
            }
        }
        else
        {
            die("Errore: $connection->error");
        }
    }
}
else if ($_SERVER["REQUEST_METHOD"] == 'GET')
{
    echo "<form method=\"post\" action=\"login.php\">
    Codice fiscale: <input type=\"text\" name=\"codice_fiscale\" required><br><br>
    Password: <input type=\"password\" name=\"password\" required><br><br>
    <button type=\"submit\" name='action' value=\"login\">Accedi</button>
    </form>";
}
?>
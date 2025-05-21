<?php
ob_start();
session_start();
require_once("db/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "register" && isset($_POST["codice_fiscale"]) && isset($_POST["password"]))
{
    $cod_f = $_POST['codice_fiscale'];
    $pwd = $_POST['password'];

    var_dump($cod_f);
    var_dump($pwd);

    $result = $connection->query("SELECT * FROM utente WHERE cod_f='$cod_f' AND pwd='$pwd'");

    if ($result && $result->num_rows > 0)
    {
        echo "Utente già registrato";
        header("Location: login.php");
        exit;
    }
    else
    {
        $result = $connection->query("INSERT INTO utente (cod_f, pwd) VALUES ('$cod_f', '$pwd')");

        if ($result)
        {
            $_SESSION["codice_fiscale"] = $cod_f;
            $_SESSION["pwd"] = $pwd;

            header("Location: dashboard_gare.php");
            exit;
        }
        else
            echo "Errore durante la registrazione";
    }
}
/*echo "<form method=\"post\" action=\"registration.php\">
    Codice fiscale: <input type=\"text\" name=\"codice_fiscale\" required><br><br>
    Password: <input type=\"password\" name=\"password\" required><br><br>
    <button type=\"submit\" name='action' value=\"register\">Registrati</button>
    </form>
    
    <form method=\"get\" action=\"login.php\">
    <button type=\"submit\" name='action' value=\"login\">Accedi</button>
    </form>";*/
?>

<html>
    <form method="post" action="registration.php">
        Codice fiscale: <input type="text" name="codice_fiscale" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit" name='action' value="register">Registrati</button>
    </form>
    
    <form method="get" action="login.php">
        <button type="submit" name='action' value="login">Accedi</button>
    </form>
</html>
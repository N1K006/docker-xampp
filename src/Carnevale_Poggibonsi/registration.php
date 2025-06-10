<?php
session_start();
ob_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    if (isset($_POST['action']) && $_POST['action'] == 'register')
    {
        $cod_f = $_POST['codice_fiscale'];
        $pwd = $_POST['password'];
        $pwd = md5($pwd);

        $result = $connection->query("SELECT * FROM utenti WHERE c_f='$cod_f' AND pwd='$pwd'");

        if ($result && $result->num_rows > 0)
        {
            echo "Email già in uso, cambia l'email";
        }
        else
        {
            $result = $connection->query("INSERT INTO utenti (c_f, pwd) VALUES ('$cod_f', '$pwd')");

            $_SESSION["codice_fiscale"] = $cod_f;
            $_SESSION["pwd"] = $pwd;

            if ($result)
            {
                echo "Registrazione avvenuta con successo";
                header("Location: dashboard.php");
                exit;
            }
        }
        die("Errore: $connection->error");
    }
}
?>
<html>
<form method="post" action="registration.php">
    Codice fiscale: <input type="text" name="codice_fiscale" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name='action' value="register">Registrati</button>
</form>

<form method="get" action="login.php">
    <button type="submit">Accedi</button>
</form>
</html>

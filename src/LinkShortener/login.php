<?php
session_start();
ob_start();  // Inizia il buffer di output
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $action = $_POST['action'];

    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $pwd = md5($pwd);

    if ($_POST['action'] == 'login')
    {
        $query = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";
        $result = $connection->query($query);

        if ($result)
        {
            if ($result->num_rows > 0)
            {
                if ($row = $result->fetch_assoc())
                {
                    $_SESSION["id_utente"] = $row['id_utente'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["email"] = $row['email'];
                    
                    header("Location: dashboard.php");
                    exit;
                }
            }
        }
        else
        {
            echo "Credenziali errate";
        }
    }
    else if ($_POST['action'] == 'register')
    {
        $username = $_POST['username'];
        $genere = $_POST['genere'];
        $dataNascita = $_POST['dataNascita'];

        $query = "SELECT * FROM users WHERE email='$email'";    
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0)
        {
            echo "Email già in uso, cambia l'email";
        }
        else
        {
            $query = "INSERT INTO users (username, email, pwd, genere, data_nascita) VALUES ('$username', '$email', '$pwd', '$genere', '$dataNascita')";
            $result = $connection->query($query);

            if ($result)
            {
                echo "Registrazione avvenuta con successo";
                header("Location: accedi.html");
                exit;
            }
            else
            {
                echo "Errore durante la registrazione";
            }
        }
    }
}
?>
<?php
session_start();
ob_start();  // Inizia il buffer di output
include "DB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    if ($_POST['action'] == 'login') 
    {
        $query = "SELECT * FROM utenti WHERE email='$email' AND pwd='$pwd'";
        $result = $connection->query($query);

        if ($result) {
            if ($row = $result->fetch_assoc()) 
            {
                $_SESSION["id_utente"] = $row['id_utente'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["genere"] = $row['genere'];
                $_SESSION["data_nascita"] = $row['data_nascita'];
                
                header("Location: rooms.php");
                exit;  // Ricorda di aggiungere 'exit;' dopo header per fermare l'esecuzione del codice
            } 
            else 
            {
                echo "Credenziali errate";
            }
        }
    }
    else if ($_POST['action'] == 'register') 
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $genere = $_POST['genere'];
        $dataNascita = $_POST['dataNascita'];

        $query = "SELECT * FROM utenti WHERE email='$email'";
        $result = $connection->query($query);

        if ($result) 
        {
            if ($result->num_rows > 0) 
            {
                echo "Email già in uso, cambia l'email";
            } 
            else 
            {
                $query = "INSERT INTO utenti (username, email, pwd, genere, data_nascita) VALUES ('$username', '$email', '$pwd', '$genere', '$dataNascita')";
                $result = $connection->query($query);

                if ($result) 
                {
                    $_SESSION["id_utente"] = $connection->insert_id;
                    echo "Registrazione avvenuta con successo";
                    header("Location: rooms.php");
                    exit;  
                } 
                else 
                {
                    echo "Errore durante la registrazione";
                }
            }
        }
    }
}
?>
<?php
    if ($_GET != null)
    {
        $username = $_GET['username'];
        $pw = $_GET['password'];

        //connessione al db
        //...

        $query = "SELECT * FROM utenti WHERE username='$username' AND password='$pw';"
    }
    else if ($_POST == null)
        echo "richiesta non tramite POST o parametri assenti";
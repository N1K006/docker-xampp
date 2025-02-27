<?php
session_start();
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard of links</title>
        <link rel="stylesheet" href="stile.css">
    </head>

    <body>
        <header class="custom-header"style = "background-color: blue;">
            <h1>Dashboard di link</h1>
        </header>

        <table border="10">
            <thead>
                <tr>
                    <th>Link Originale</th>
                    <th>Link Short</th>
                </tr>
            </thead>
            <tbody id="link_table_body">
            </tbody>
        </table>
</html>

<!-- Form per inviare i link -->
<div class="space-form">
    <form id="link_form" action="link_shortener.php" method="post">
        <input id="link" type="text" name="original_link" required placeholder="Inserisci il tuo link...">
        <button type="submit" name="action" value="link_shortener">Invia</button><br><br>
    </form>
</div>

<script>
    const form = document.getElementById('link_form');

    form.addEventListener('submit', function(event)
    {
        event.preventDefault(); // non ti renderizza

       

        fetch("link_shortener.php", 
        {
            method: 'POST',
            body: new FormData(form)
        });

        document.getElementById('link').value="";
    });
    
</script>

<script>

    let previousData = null; // Variabile per salvare i dati precedenti

    function aggiornaLink() {
        fetch("get_links.php")
            .then(response => response.json())
            .then(data => {
                // Se i dati sono uguali a quelli precedenti, non fare nulla
                if (JSON.stringify(data) === JSON.stringify(previousData)) // stringify -> converte in string a data (dati del form)
                    return;

                // Salva i nuovi dati
                previousData = data;

                const tableBody = document.getElementById("link_table_body");
                tableBody.innerHTML = ""; // Svuota la tabella prima di aggiornarla
                
                data.forEach(link => {
                    const row = document.createElement("tr"); // Crea una riga

                    // cose da fare con il link
                    const original_link_Div = document.createElement("td");
                    original_link_Div.textContent = link.original_link;
                    row.appendChild(original_link_Div); //aggiungo al container (original_links) il div creato con dentro il link

                    const shorted_link_Div = document.createElement("td");
                    shorted_link_Div.textContent = "https://3000-idx-docker-xampp-1736234920290.cluster-y34ecccqenfhcuavp7vbnxv7zk.cloudworkstations.dev/LinkShortener/redirect.php?link_id=" + link.id_link;
                    row.appendChild(shorted_link_Div);

                    tableBody.appendChild(row); // Aggiunge la riga alla tabella
                });
            })
            .catch(err => console.error("Errore:", err));
    }

    setInterval(aggiornaLink, 500);
    aggiornaLink();
</script>
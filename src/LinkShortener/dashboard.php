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
        <header class="custom-header" style="background-color: blue;">
            <h1>Dashboard di link</h1>
        </header>

        <table border="10">
            <!-- intestazione -->
            <thead>
                <tr>
                    <th>Link Originale</th>
                    <th>Link Short</th>
                    <th>Visite</th> <!-- contenuto dell'intestazione -->
                </tr> <!-- riga dell'intestazione -->
            </thead> <!-- raggruppa tutte le intestazioni della tabella -->
            
            <tbody id="link_table_body"> <!-- separa il contenuto dal thead (td -> contenuto della cella) --> 
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


<script> // Questo script server per inviare il form senza ricaricare la pagina

    // Ottieni il form
    const form = document.getElementById('link_form');

    // appena l'utente clicca "invia" questa funzione viene eseguita
    form.addEventListener('submit', function(event)
    {
        event.preventDefault(); // Evita la ricarica della pagina

        // Invia il form a link_shortener.php in modo invisibile
        fetch("link_shortener.php", 
        {
            method: 'POST',
            body: new FormData(form) 
        });

        document.getElementById('link').value=""; 
    });
    
</script>

<script>

    let previousData = null; // Variabile per salvare i dati precedenti della tabella

    // funzione che aggiorna la tabella con i nuovi dati
    function aggiornaLink() { 
        fetch("get_links.php") // richiede i dati al file PHP get_links.php
            .then(response => response.json()) 

            // appena riceve i dati esegue tutto il codice
            .then(data => {
                // Se i dati sono uguali a quelli precedenti, non fare nulla
                if (JSON.stringify(data) === JSON.stringify(previousData)) // stringify -> converte in string a data (dati del form)
                    return;

                // Salva i nuovi dati
                previousData = data;

                const tableBody = document.getElementById("link_table_body");
                tableBody.innerHTML = ""; // Svuota la tabella prima di aggiornarla per evitare duplicazioni
                
                // scorre tutti i link ricevuti e li aggiunge uno alla volta
                data.forEach(link => {
                    
                    const row = document.createElement("tr"); // Crea una riga 

                    // Aggiunge il link originale alla cella
                    const original_link_Div = document.createElement("td");
                    original_link_Div.textContent = link.original_link;
                    row.appendChild(original_link_Div); //aggiungo al container (original_links) il div creato con dentro il link

                    const shorted_link_Div = document.createElement("td");

                    // Aggiunge il link alla cella
                    const a = document.createElement("a");
                    a.href = "https://3000-idx-docker-xampp-1736234920290.cluster-y34ecccqenfhcuavp7vbnxv7zk.cloudworkstations.dev/LinkShortener/redirect.php?link_id=" + link.id_link;
                    a.textContent = a.href;
                    shorted_link_Div.appendChild(a);
                    row.appendChild(shorted_link_Div);

                    // Aggiunge il numero di visite alla cella
                    const visits_Div = document.createElement("td");
                    // Applica la classe 'text-visite' alla cella
                    visits_Div.classList.add("text-visite");
                    visits_Div.textContent = link.n_visite;
                    row.appendChild(visits_Div);

                    tableBody.appendChild(row); // Aggiunge la riga alla tabella
                });
            })
            .catch(err => console.error("Errore:", err));
    }

    setInterval(aggiornaLink, 500);
    aggiornaLink();
</script>
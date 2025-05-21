<?php
/* API: Application Programming Interface (Interfaccia di Programmazione delle Applicazioni) è un insieme di 
operazioni o funzioni che un programmatore può utilizzare per interagire con un'applicazione o un servizio esterno*/

    header('Content-Type: application/json');

    $data = [
        ['nome'=>'Mario', 'cognome'=>'Rossi', 'email'=>'mario.rossi@example.it'],
        ['nome'=>'Luca', 'cognome'=>'Verdi', 'email'=>'luca.verdi@example.it'],
        ['nome'=>'Federico', 'cognome'=>'Bordi', 'email'=>'federico.bordi@example.it']
    ];

    echo json_encode($data);
?>
async function fetchData()
{
    // percorso relativo
    const url = "../api/data.php";
    try 
    {
        const response = await fetch(url); // oggetto risposta
        const data = await response.json; // decodificare la risposta
        console.log(data);
        return data;
    }
    catch (error)
    {
        console.error("Errore recupero dati:", error);
        return [];
    }
}

async function populateTable()
{
    const data = await fetchData(); // per richiamare una funzione asincrona si usa l'await
    const data_table = document.getElementById("data-table");

    /*// pulisce il contenuto della tabella 
    data_table.innerHtml = ''; // è tutto il codice dell'html che è scritto tutto dentro test_ws.html*/

    // prende ogni elemento dell'array e lo aggiunge alla tabella
    data.forEach(element => {
        const row = document.createElement('tr');
        const data1 = document.createElement('td');
        const data2 = document.createElement('td');
        const data3 = document.createElement('td');
        data1.textContent = element.nome;
        data2.textContent = element.cognome;
        data3.textContent = element.email;
        row.appendChild(data1);
        row.appendChild(data2);
        row.appendChild(data3);
        data_table.appendChild(row);
    });
}

// associa il click del bottone alla funzione populateTable populateTable();
document.getElementById("load-data-button").addEventListener('click', populateTable); 

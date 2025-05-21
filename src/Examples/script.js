async function fetchData(url)
{
    // percorso relativo
    try 
    {
        const response = await fetch(url); // oggetto risposta
        const data = await response.json(); // decodificare la risposta
        console.log(data);
        return data;
    }
    catch (error)
    {
        console.error("Errore nel recupero dei dati:", error);
        return [];
    }
}

async function populateTable(url)
{
    const data = await fetchData(url); // per richiamare una funzione asincrona si usa l'await
    const data_table = document.getElementById("data-table");

    data_table.innerHTML = ''; // è tutto il codice dell'html che è scritto tutto dentro test_ws.html

    const thead = document.createElement('thead');
    const tbody = document.createElement('tbody');
    
    const row = document.createElement('tr');
    const data1 = document.createElement('th');
    const data2 = document.createElement('th');
    const data3 = document.createElement('th');
    data1.textContent = "Nome";
    data2.textContent = "Cognome";
    data3.textContent = "Email";
    row.appendChild(data1);
    row.appendChild(data2);
    row.appendChild(data3);
    thead.appendChild(row);
    data_table.appendChild(thead);

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
        tbody.appendChild(row);
    });
    data_table.appendChild(tbody);
}

// associa il click del bottone alla funzione populateTable populateTable();
document.getElementById("load-data-button").addEventListener('click', () => populateTable("../api/data.php")); 

document.getElementById("load-data-button-db").addEventListener('click', () => populateTable("../api/users.php"));

CREATE TABLE utente 
(
    cod_f VARCHAR(16) PRIMARY KEY,
    pwd VARCHAR(16) NOT NULL,
    ruolo boolean NOT NULL
);

CREATE TABLE kart
(
    num_kart INT PRIMARY KEY
);

CREATE TABLE gara
(
    id_gara INT AUTO_INCREMENT PRIMARY KEY,
    data_gara DATE NOT NULL
);

CREATE TABLE partecipazione
(
    posizione INT NOT NULL,
    cod_f VARCHAR(16) NOT NULL,
    id_gara INT NOT NULL,
    num_kart INT NOT NULL,
    PRIMARY KEY(cod_f, id_gara, num_kart),
    FOREIGN KEY (cod_f) REFERENCES utente(cod_f) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_gara) REFERENCES gara(id_gara) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (num_kart) REFERENCES kart(num_kart) ON DELETE RESTRICT ON UPDATE CASCADE
);
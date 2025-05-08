-- Creazione del database se non esiste già
CREATE DATABASE IF NOT EXISTS club_giochi;
USE club_giochi;

-- Tabella Soci: contiene le informazioni sui membri del Club
CREATE TABLE soci (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quota_anno INT NOT NULL, -- Anno in cui ha versato la quota o donato un gioco
    tipo ENUM('Regolare', 'Donatore', 'Curatore') DEFAULT 'Regolare' -- Ruolo del socio
);

-- Tabella Giochi: contiene i giochi presenti nel Club
CREATE TABLE giochi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    quantita INT NOT NULL DEFAULT 1, -- Quante copie del gioco sono disponibili (max 3)
    data_acquisto DATE NOT NULL,
    id_donatore INT, -- Socio che ha donato il gioco (opzionale)
    FOREIGN KEY (id_donatore) REFERENCES soci(id) ON DELETE SET NULL
);

-- Tabella Prestiti: registra quando un socio prende un gioco
CREATE TABLE prestiti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_socio INT NOT NULL,
    id_gioco INT NOT NULL,
    data_prestito DATE NOT NULL,
    data_restituzione DATE, -- Può essere NULL se il gioco non è ancora stato restituito
    FOREIGN KEY (id_socio) REFERENCES soci(id),
    FOREIGN KEY (id_gioco) REFERENCES giochi(id)
);

-- Tabella Incontri: registra le sessioni di gioco
CREATE TABLE incontri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_incontro DATE NOT NULL
);

-- Tabella Partecipanti: collega soci e incontri
CREATE TABLE partecipanti (
    id_incontro INT,
    id_socio INT,
    PRIMARY KEY (id_incontro, id_socio),
    FOREIGN KEY (id_incontro) REFERENCES incontri(id),
    FOREIGN KEY (id_socio) REFERENCES soci(id)
);

-- Tabella Vincitori: identifica i vincitori degli incontri
CREATE TABLE vincitori (
    id_incontro INT,
    id_socio INT,
    PRIMARY KEY (id_incontro, id_socio),
    FOREIGN KEY (id_incontro) REFERENCES incontri(id),
    FOREIGN KEY (id_socio) REFERENCES soci(id)
);
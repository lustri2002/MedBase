create database if not exists MedBase;

CREATE TABLE IF NOT EXISTS Reparto
(
    idR      INT AUTO_INCREMENT NOT NULL,
    NomeR    VARCHAR(32) NOT NULL,
    MaxPosti INT NOT NULL,

    PRIMARY KEY (idR)
);

CREATE TABLE IF NOT EXISTS Personale
(
    idP        INT AUTO_INCREMENT NOT NULL,
    username   VARCHAR(32) NOT NULL,
    password   VARCHAR(32) NOT NULL,
    privilegio INT NOT NULL,

    PRIMARY KEY (idP)
);

create table if not exists Assistito
(
    idA      INT AUTO_INCREMENT NOT NULL,
    nomeA    VARCHAR(32) NOT NULL,
    cognomeA VARCHAR(32) NOT NULL,
    CF       CHAR(16) NOT NULL,

    PRIMARY KEY (idA)
);

create table if not exists Degenza
(
    idD INT AUTO_INCREMENT NOT NULL,
    DataIn DATE NOT NULL,
    DataOut DATE,
    idA INT NOT NULL,
    idR INT NOT NULL,

    PRIMARY KEY (idD),
    FOREIGN KEY (idA) REFERENCES Assistito (idA),
    FOREIGN KEY (idR) REFERENCES Reparto   (idR)
);
create database if not exists MedBase;

CREATE TABLE IF NOT EXISTS reparti
(
    idR      INT AUTO_INCREMENT NOT NULL,
    NomeR    VARCHAR(32) NOT NULL,
    MaxPosti INT NOT NULL,

    PRIMARY KEY (idR)
);

INSERT INTO reparti (NomeR, MaxPosti) VALUES ('Cardiologia', 25);
INSERT INTO reparti (NomeR, MaxPosti) VALUES ('Pneumologia', 5);
INSERT INTO reparti (NomeR, MaxPosti) VALUES ('Terapie intensive', 2);

CREATE TABLE IF NOT EXISTS personale
(
    idP        INT AUTO_INCREMENT NOT NULL,
    username   VARCHAR(32) NOT NULL,
    password   VARCHAR(128) NOT NULL,
    privilegio INT NOT NULL,

    PRIMARY KEY (idP)
);

INSERT INTO personale (username, password, privilegio) VALUES ('admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 31);
INSERT INTO personale (username, password, privilegio) VALUES ('analista', '659b83afdc290b9e794af4fb2bec4ebb416ebeecc6efd3f0d957e1f1923e5b088e97bfa41e2385c77d24da9e7f0fd0ca716213052154f7bbc58ecaef45e55843', 1);
INSERT INTO personale (username, password, privilegio) VALUES ('direttore', 'b6af56c356c4dc45fea6e06b3703cddca0bd1cba3dc919d71927c37639ec04a61688094334efdd911dad7524cbaeffda2dc7add17459e20a0ab7d7da4880a1f2', 8);

create table if not exists assistiti
(
    idA      INT AUTO_INCREMENT NOT NULL,
    nomeA    VARCHAR(32) NOT NULL,
    cognomeA VARCHAR(32) NOT NULL,
    CF       CHAR(16) NOT NULL,

    PRIMARY KEY (idA)
);

INSERT INTO assistiti (nomeA, cognomeA, CF) VALUES ('Alessio', 'Lustri', 'LSTLSS02B19F839U');
INSERT INTO assistiti (nomeA, cognomeA, CF) VALUES ('Gabriel', 'Amore', 'MRAGRL02P09H892Y');
INSERT INTO assistiti (nomeA, cognomeA, CF) VALUES ('Vittorio', 'Picone', 'PCNVTR02L30F839G');

create table if not exists degenze
(
    idD INT AUTO_INCREMENT NOT NULL,
    DataIn DATE NOT NULL,
    DataOut DATE,
    idA INT NOT NULL,
    idR INT NOT NULL,

    PRIMARY KEY (idD),
    FOREIGN KEY (idA) REFERENCES assistiti (idA),
    FOREIGN KEY (idR) REFERENCES  reparti   (idR)
);

INSERT INTO degenze (DataIn, DataOut, idA, idR) VALUES ('2020/10/10', '2020/10/20', 1, 1);
INSERT INTO degenze (DataIn, DataOut, idA, idR) VALUES ('2020/11/20', '2020/12/10', 2, 2);
INSERT INTO degenze (DataIn, DataOut, idA, idR) VALUES ('2021/01/10', '2021/01/15', 3, 3);

select count(*) as PostiOccupati from degenza where DataOut is null and idR=?;
select datediff(DataOut, DataIn)+1 as Giorni from degenza where idR=$idR and DataOut is not null;


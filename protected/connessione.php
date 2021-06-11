<?php

define('NOMEDATABASE', 'Lustri_medbase');
define('SERVERDATABASE', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');

$con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD);

if ($con->connect_errno != 0)
{
    echo "<SCRIPT>alert('Connessione server fallita');</SCRIPT>";
}
else
{
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . NOMEDATABASE . "'";
    $ris = mysqli_query($con, $sql);
    if ($ris->num_rows === 0) //se non vengono restituite righe crea il database
        creaDB();
		
    else    //altrimenti lo si seleziona
        $con->select_db(NOMEDATABASE);
}

function CheckReparti($idR){
    //Funzione che verifica la disponibilità di posti letto in un reparto
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql="SELECT MaxPosti-PostiOccupati As PostiLiberi
          FROM (
                (select count(*) as PostiOccupati from degenza where DataOut is null and idR=$idR) AS PostiOccupati,
                (select MaxPosti from  reparto where idR = $idR ) AS MaxPosti
               )";
    $Result = mysqli_query($con, $sql);
    $PostiLiberi = $Result->fetch_object()->PostiLiberi;
    return $PostiLiberi > 0;
}

function alert($msg, $path){
    echo "
    <script type='text/javascript'>
        alert('$msg');
        window.location.href='$path';
    </script>";
}

function CheckDegenza($idA){
    //VERIFICA CHE IL PAZIENTE NON SIA GIà RICOVERATO IN QUEL REPARTO
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql = "select count(*) AS DegenzeAttive from degenza where idA=$idA and DataOut is null";
    $DegenzeAttive = mysqli_query($con,$sql)->fetch_object()->DegenzeAttive;
    return $DegenzeAttive;
}

function CalcolaMedia($idR){
    //Calcolo della media in un singolo reparto
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql = "SELECT datediff(DataOut, DataIn)+1 as Giorni from degenza where idR=$idR and DataOut is not null";
    $Result = mysqli_query($con, $sql);
    $NumRicoveri = $Result->num_rows;
    $SommaGiorni = 0;
    if($NumRicoveri == 0)
        return 0;
    else {
        while ($row = $Result->fetch_object()) $SommaGiorni += $row->Giorni;
        return $SommaGiorni/$NumRicoveri;
    }
}

function creaDB(){
    /*Crea il database con le tabelle  e inserisce l'utente admin con cui effettuare il primo accesso*/
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD);
    // Crea database
    mysqli_query($con, "create database if not exists ". NOMEDATABASE);
    $con->select_db(NOMEDATABASE);
    //creazione tabella reparto
    $table = "
        CREATE TABLE IF NOT EXISTS reparto
        (
            idR      INT AUTO_INCREMENT NOT NULL,
            NomeR    VARCHAR(32) NOT NULL,
            MaxPosti INT NOT NULL,
        
            PRIMARY KEY (idR)
        );
    ";
    mysqli_query($con, $table);
    //creazione tabella assistito
    $table = "
        create table if not exists assistito
        (
            idA      INT AUTO_INCREMENT NOT NULL,
            nomeA    VARCHAR(32) NOT NULL,
            cognomeA VARCHAR(32) NOT NULL,
            CF       CHAR(16) NOT NULL,
        
            PRIMARY KEY (idA)
        );
    ";
    mysqli_query($con, $table);
    //creazione tabella personale
    $table = "
        CREATE TABLE IF NOT EXISTS personale
        (
            idP        INT AUTO_INCREMENT NOT NULL,
            username   VARCHAR(32) NOT NULL,
            password   VARCHAR(128) NOT NULL,
            privilegio INT NOT NULL,
        
            PRIMARY KEY (idP)
        );
    ";
    mysqli_query($con, $table);
    //creazione tabella degenza
    $table = "
        create table if not exists degenza
        (
            idD INT AUTO_INCREMENT NOT NULL,
            DataIn DATE NOT NULL,
            DataOut DATE,
            idA INT NOT NULL,
            idR INT NOT NULL,
        
            PRIMARY KEY (idD),
            FOREIGN KEY (idA) REFERENCES assistito (idA),
            FOREIGN KEY (idR) REFERENCES  reparto   (idR)
        );
    ";
    mysqli_query($con, $table);
    //inserimento dell'utente di admin
    $insert = " INSERT INTO personale (username, password, privilegio) 
                VALUES ('admin', 
                        'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec',
                        31);";
    mysqli_query($con, $insert);
}
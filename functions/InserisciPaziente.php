<?php
    $nome = $_POST['nomePaziente'];
    $cognome = $_POST['cognomePaziente'];
    $CF = $_POST['CF'];
    $CF = strtoupper($CF);
    $idR = $_POST['nomeR'];
    $DataInizio = date("Y-m-d");

    $nome = str_replace('\'', '`', $nome);
    $cognome = str_replace('\'', '`', $cognome);
    require "../protected/connessione.php";
    $sql = "SELECT CF, idA FROM Assistito WHERE CF = '$CF'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)===0)
    {
        $sql = "INSERT INTO assistito(nomeA, cognomeA, CF) VALUES ('$nome', '$cognome', '$CF')";
        if(mysqli_query($con, $sql))
        {
            $idA = $con->insert_id; //Prende l'ID dell'ultimo insert
        }
    }
    else {
        $idA = $result->fetch_object()->idA;
    }
    $DegenzeAttive = CheckDegenza($idA);
    //echo $DegenzeAttive;
    if(CheckReparti($idR) AND ($DegenzeAttive==0)) {
        $sql="INSERT INTO degenza(DataIn, idA, idR) VALUES ('$DataInizio', '$idA', '$idR')";
        if(mysqli_query($con,$sql)) {
            alert("PAZIENTE INSERITO");
        }
    }
    else alert("REPARTO PIENO O CI SONO ALTRE DEGENZE ATTIVE CON QUEL CODICE FISCALE");
    header("refresh:3,url=../InserimentoPazienti.php");
?>
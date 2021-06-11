<?php

    /*
     * lo script prende tutti i parametri dategli dal personale che l'ha
     * inserito, poi va a verificare se quel codice fiscale esiste già
     * all'interno del database, se si prende l'id altrimenti lo aggiunge.
     * Successivamente va a verificare la disponibilità nel reparto e
     * controlla che il paziente non sia già ricoverato presso
     * un altro reparto, e in caso sia possibile va a creare una nuova degenza,
     * altrimenti va a creare una nuova degenza.
    */
    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente_Medbase'])) or (($_SESSION['utente_Medbase']->privilegio & 2) == 0)){
        alert('Non consentito','../index.php');
        die();
    }

    $nome = $_POST['nomePaziente'];
    $cognome = $_POST['cognomePaziente'];
    $CF = $_POST['CF'];
    $CF = strtoupper($CF);
    $idR = $_POST['nomeR'];
    $DataInizio = date("Y-m-d");

    $nome = str_replace('\'', '`', $nome);
    $cognome = str_replace('\'', '`', $cognome);

    $sql = "SELECT CF, idA FROM assistito WHERE CF = '$CF'";
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
            alert("PAZIENTE INSERITO", "../InserimentoPazienti.php");
        }
    }
    else if ($DegenzeAttive>0){
        alert("Il paziente è già ricoverato in un altro reparto", "../InserimentoPazienti.php");
    }
    else{
        $NomeR = mysqli_query($con, "SELECT NomeR from  reparto where idR = '$idR'")->fetch_object()->NomeR;
        alert("Il  reparto di $NomeR è pieno", "../InserimentoPazienti.php");
    }

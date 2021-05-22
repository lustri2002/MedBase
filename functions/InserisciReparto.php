<?php

    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente'])) or (($_SESSION['utente']->privilegio & 8) == 0)){
        alert('Non consentito','../index.php');
        die();
    }
    $nome = $_POST["nomeR"];
    $maxPosti = $_POST["maxPosti"];

    $sql = "select nomeR from  reparto where NomeR='$nome'"; //echo $sql;
    $result = mysqli_query($con,$sql);
    $num_righe = mysqli_num_rows($result); //echo $num_righe;
    if($num_righe>0){
        alert("Reparto già esistente", "../GestioneReparti.php");
    }
    else {
        $sql = "insert into reparto(NomeR,MaxPosti)
                values ('$nome','$maxPosti')";
        if(mysqli_query($con,$sql))
            header("location: ../GestioneReparti.php");
        else alert("Errore nella query \n $sql", "../GestioneReparti.php");
    }


<?php
    session_start();
    $nome = $_POST["nomeR"];
    $maxPosti = $_POST["maxPosti"];

    require "../protected/connessione.php";
    $sql = "select NomeR from reparto where NomeR='$nome'"; //echo $sql;
    $result = mysqli_query($con,$sql);
    $num_righe = mysqli_num_rows($result); //echo $num_righe;
    if($num_righe>0){
        alert("Reparto già esistente, verrai reindirizzato in 5 sec.");
            header("refresh:5,url=../GestioneReparti.php");
    }
    else {
        $sql = "insert into Reparto(NomeR,MaxPosti)
                values ('$nome','$maxPosti')";
        if(mysqli_query($con,$sql))
            header("location: ../GestioneReparti.php");
        else alert("Errore nella query, verrai reindirizzato in 5 sec.");
        header("refresh:5,url=../GestioneReparti.php");
    }
?>

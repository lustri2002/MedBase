<?php
    $idR = $_POST["idR"];
    $maxPosti = $_POST["maxPosti"];

    require "../protected/connessione.php";
    $sql = "UPDATE Reparto SET MaxPosti = $maxPosti WHERE idR = $idR";
    if(mysqli_query($con, $sql)){
        header("location: ../GestioneReparti.php");
    }
    else {
            alert("errore nella query");
            header("refresh:3,url=../GestioneReparti.php");
    }
?>

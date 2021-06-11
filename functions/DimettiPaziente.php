<?php

    /*
    Va ad impostare la data odierna al campo DataOut di degenza
    In questo caso, la presenza di un valore nel campo dataOut significa
    il termine del ricovero
    */
    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente_Medbase'])) or (($_SESSION['utente_Medbase']->privilegio & 4) == 0)){
        die("not_allowed");
    }
    $idD = $_POST['idD'];
    $DataOut = date("Y-m-d");

    $sql = "UPDATE degenza SET DataOut = '$DataOut' WHERE idD = '$idD' AND DataOut is null";
    if(mysqli_query($con,$sql)){
        die("success");
    }
    else
        die("fail");

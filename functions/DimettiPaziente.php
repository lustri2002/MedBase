<?php
    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente'])) or (($_SESSION['utente']->privilegio & 4) == 0)){
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

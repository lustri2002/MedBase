<?php
    $CF = $_POST['CF'];
    $CF = strtoupper($CF);
    require "../protected/connessione.php";
    $sql = "SELECT * FROM Assistito WHERE CF = '$CF'";
    $Result = mysqli_query($con,$sql)->fetch_object();
    $idA = $Result->idA;
    $Nome = $Result-> nomeA;
    $Cognome = $Result-> cognomeA;

    $sql = "Select * from degenza where DataOut is null and idA ='$idA'";
    $Result = mysqli_query($con, $sql)->fetch_object();
    $DataIn = $Result -> DataIn;
    $DataIn = date("d-m-Y", strtotime($DataIn));
    $idR = $Result -> idR;

    $sql = "Select NomeR from reparto where idR='$idR'";
    $Reparto = mysqli_query($con,$sql)->fetch_object()->NomeR;

    echo "$CF; $Nome; $Cognome; $DataIn; $Reparto";
?>
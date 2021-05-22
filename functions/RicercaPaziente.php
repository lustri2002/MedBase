<?php
    $CF = $_POST['CF'];
    $CF = strtoupper($CF);
    require "../protected/connessione.php";
    $sql = "SELECT * FROM assistito WHERE CF = '$CF'";
    $Result = mysqli_query($con,$sql);
    if($Result->num_rows==0){
        die ("notFound");
    }
    else {
        $Result = $Result->fetch_object();
        $idA = $Result->idA;
        $Nome = $Result->nomeA;
        $Cognome = $Result->cognomeA;

        $sql = "Select * from degenza where DataOut is null and idA ='$idA'";
        $Result = mysqli_query($con, $sql);
        if($Result->num_rows==0){
            die("noDegenze");
        }
        else {
            $Result = $Result->fetch_object();
            $DataIn = $Result->DataIn;
            $DataIn = date("d-m-Y", strtotime($DataIn));
            $idR = $Result->idR;
            $idD = $Result->idD;
            $sql = "Select NomeR from  reparto where idR='$idR'";
            $Reparto = mysqli_query($con, $sql)->fetch_object()->NomeR;

            echo "$CF; $Nome; $Cognome; $DataIn; $Reparto; $idD";
        }
    }
?>
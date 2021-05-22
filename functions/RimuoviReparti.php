<?php
    $idR = $_POST['idR'];
    $MaxPosti = $_POST['MaxPosti'];
    $PostiOccupati = $_POST['PostiOccupati'];
    require "../protected/connessione.php";

    $sql = "select * from degenza where idR = $idR";
    $Ris = mysqli_query($con, $sql);
    if($Ris->num_rows === 0){
        if($PostiOccupati === "0"){
            $sql = "DELETE FROM  reparto WHERE idR = '$idR'";
            mysqli_query($con, $sql);
            echo "success";
        }
        else echo "failed";
    }
    else
        echo "impossible";
?>
<?php
    $idR = $_POST['idR'];
    $MaxPosti = $_POST['MaxPosti'];
    $PostiOccupati = $_POST['PostiOccupati'];
    $sql = "DELETE FROM reparto WHERE idR = '$idR'";
    require "../protected/connessione.php";
    if($PostiOccupati === "0"){
       mysqli_query($con, $sql);
       echo "success";
    }
    else echo "failed";
?>
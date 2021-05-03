<?php
    $idD = $_POST['idD'];
    $DataOut = date("Y-m-d");
    require "../protected/connessione.php";
    $sql = "UPDATE degenza SET DataOut = '$DataOut' WHERE idD = '$idD' AND DataOut is null";
    if(mysqli_query($con,$sql)){
        die("success");
    }
    else
        die("fail");

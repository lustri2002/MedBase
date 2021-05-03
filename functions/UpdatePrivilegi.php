<?php
    $Privilegio = $_POST['Privilegio'];
    $idP = $_POST['idP'];
    require "../protected/connessione.php";
    $sql = "UPDATE Personale SET privilegio = privilegio + '$Privilegio' WHERE idP = '$idP'";
    if(mysqli_query($con, $sql))
        echo "success";
    else
        echo "failed";
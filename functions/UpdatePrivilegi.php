<?php
    session_start();
    if((($_SESSION['utente_Medbase']->privilegio & 16) <= 0) or !isset($_SESSION['utente_Medbase']))
        echo "not_allowed";
    else{
        $Privilegio = $_POST['Privilegio'];
        $idP = $_POST['idP'];
        require "../protected/connessione.php";

        $sql = "UPDATE personale SET privilegio = privilegio + '$Privilegio' WHERE idP = '$idP'";
        if(mysqli_query($con, $sql))
            echo "success";
        else
            echo "failed";
    }

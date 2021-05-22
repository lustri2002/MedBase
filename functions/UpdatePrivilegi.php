<?php
    session_start();
    if((($_SESSION['utente']->privilegio & 16) <= 0) or !isset($_SESSION['utente']))
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

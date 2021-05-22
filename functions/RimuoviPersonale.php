<?php
    $idP = $_POST['idP'];

    require "../protected/connessione.php";
    if(mysqli_query($con, "delete from personale  where idP='$idP'")){
        echo "success";
    }
    else
        echo "failed";
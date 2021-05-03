<?php
    $CF = $_POST["CF"];
    require "../protected/connessione.php";
    $sql = "select DataOut, date_format(DataIn, '%d-%m-%Y') as DataIn, NomeR, nomeA, cognomeA, CF 
            from degenza as D, assistito as A, reparto as R 
            where D.idA = A.idA AND A.CF = '$CF' AND R.idR = D.idR";

    if($Result = mysqli_query($con, $sql))
        echo json_encode($Result->fetch_all(MYSQLI_ASSOC));
    else
        echo "failed";
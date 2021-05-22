<?php
    $CF = $_POST["CF"];
    require "../protected/connessione.php";
    $sql = "select date_format(DataOut,'%d-%m-%Y') as DataOut, date_format(DataIn, '%d-%m-%Y') as DataIn, NomeR, nomeA, cognomeA, CF 
            from degenza as D, assistito as A,  reparto as R 
            where D.idA = A.idA AND A.CF = '$CF' AND R.idR = D.idR";
    $Result = mysqli_query($con, $sql);
    if($Result->num_rows>0)
        echo json_encode($Result->fetch_all(MYSQLI_ASSOC));
    else
        echo "failed";
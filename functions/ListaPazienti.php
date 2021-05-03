<?php
    $idR = $_POST["idR"];
    require "../protected/connessione.php";

    $sql = "select NomeA, CognomeA, CF 
            from degenza as D, assistito as A 
            where D.idR='$idR' and D.DataOut is null and A.idA = D.idA";
    $result = mysqli_query($con,$sql);
    while($row = $result->fetch_object()){
        echo "$row->NomeA;$row->CognomeA;$row->CF\n";
    }
<?php

define('NOMEDATABASE', 'medbase');
define('SERVERDATABASE', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '19022002');

$con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD);

if ($con->connect_errno != 0)
{
    echo "<SCRIPT>alert('Connessione Server Fallita');</SCRIPT>";
}
else
    $con->select_db(NOMEDATABASE);

function CheckReparti($idR){
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql="SELECT MaxPosti-PostiOccupati As PostiLiberi
          FROM (
                (select count(*) as PostiOccupati from degenza where DataOut is null and idR=$idR) AS PostiOccupati,
                (select MaxPosti from  reparto where idR = $idR ) AS MaxPosti
               )";
    $Result = mysqli_query($con, $sql);
    $PostiLiberi = $Result->fetch_object()->PostiLiberi;
    return $PostiLiberi > 0;
}

function alert($msg, $path){
    echo "
    <script type='text/javascript'>
        alert('$msg');
        window.location.href='$path';
    </script>";
}

function CheckDegenza($idA){ //VERIFICA CHE IL PAZIENTE NON SIA GIà RICOVERATO IN QUEL REPARTO
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql = "select count(*) AS DegenzeAttive from degenza where idA=$idA and DataOut is null";
    $DegenzeAttive = mysqli_query($con,$sql)->fetch_object()->DegenzeAttive;
    return $DegenzeAttive;
}

function CalcolaMedia($idR){
    $con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD, NOMEDATABASE);
    $sql = "SELECT datediff(DataOut, DataIn)+1 as Giorni from degenza where idR=$idR and DataOut is not null";
    $Result = mysqli_query($con, $sql);
    $NumRicoveri = $Result->num_rows;
    $SommaGiorni = 0;
    if($NumRicoveri == 0)
        return 0;
    else {
        while ($row = $Result->fetch_object()) $SommaGiorni += $row->Giorni;
        return $SommaGiorni/$NumRicoveri;
    }
}
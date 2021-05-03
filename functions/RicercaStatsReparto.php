<?php
    $idR = $_POST["idR"];
    require "../protected/connessione.php";

    $sql = "select count(*) as PostiOccupati from degenza where DataOut is null and idR=$idR";
    $PostiOccupati = mysqli_query($con, $sql)->fetch_object()->PostiOccupati;

    $sql = "select NomeR, MaxPosti from reparto";
    $Result=mysqli_query($con, $sql)->fetch_object();
    $nomeR = $Result->NomeR;
    $MaxPosti = $Result -> MaxPosti;

    $MediaRicovero = CalcolaMedia($idR);
    if($MediaRicovero==0) $MediaRicovero="Dati mancanti";
    echo "$nomeR; $MaxPosti; $PostiOccupati; $MediaRicovero";

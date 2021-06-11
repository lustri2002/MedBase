<?php
/*------------------------------------------------------
    Funzione che va ad aggiorare l'attributo MaxPosti
    della tabella Reparti prendendone l'Id dall'array
    POST.
------------------------------------------------------*/
    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente_Medbase'])) or (($_SESSION['utente_Medbase']->privilegio & 8) == 0)){
        alert('Non consentito','../index.php');
        die();
    }

    $idR = $_POST["idR"];
    $maxPosti = $_POST["maxPosti"];
    $sql = "select count(*) as PostiOccupati from degenza where DataOut is null and idR='$idR'";
    $PostiOccupati = mysqli_query($con, $sql)->fetch_object()->PostiOccupati;
    if($maxPosti >= $PostiOccupati){
        $sql = "UPDATE reparto SET MaxPosti = $maxPosti WHERE idR = $idR";
        if(mysqli_query($con, $sql)){
            header("location: ../GestioneReparti.php");
        }
        else {
            alert("errore nella query", "../GestioneReparti.php");
        }
    }
    else
        alert("Il  reparto è troppo pieno per dimunuirne i posti", "../GestioneReparti.php");

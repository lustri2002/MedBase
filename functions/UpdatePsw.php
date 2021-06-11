<?php
    require "../protected/connessione.php";

    $oldpsw = $_POST['oldpsw'];
    $psw = $_POST['psw'];
    $pswConfirm = $_POST['pswconfirm'];
    session_start();
    if(hash("sha512",$oldpsw) === $_SESSION['utente_Medbase']->password){
        if($psw === $pswConfirm){
            $psw = hash("sha512", $psw);
            $idU = $_SESSION['utente_Medbase']->idP;
            $sql = "UPDATE personale  SET password = '$psw' WHERE idP = $idU";
            if(mysqli_query($con,$sql)){
                alert("Password modificata","../index.php");
            }
            else
                alert("Errore, contattare l'assistenza","../index.php");
        }
        else
            alert("La nuova password non corrisponde", "../index.php");
    }
    else
        alert("La password attuale è errata", "../index.php");
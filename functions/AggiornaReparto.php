<?php
    $idR = $_POST["idR"];
    $maxPosti = $_POST["maxPosti"];

    require "../protected/connessione.php";
    $sql = "UPDATE Reparto SET MaxPosti = $maxPosti WHERE idR = $idR";
    if(mysqli_query($con, $sql)){
        header("location: ../GestioneReparti.php");
    }
    else {echo "
             <div class='login_error_box'>  
                <p class='login_error'>Errore nella query</p>
             </div>";
            header("refresh:3,url=../GestioneReparti.php");
    }
?>

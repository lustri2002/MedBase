<?php
    $idR = $_POST['Remove'];
    $sql = "DELETE FROM reparto WHERE idR = $idR";
    require "../protected/connessione.php";
    if(mysqli_query($con, $sql)){
        header("location: ../GestioneReparti.php");
        //echo $sql;
    }
    else echo "
                 <div class='login_error_box'>  
                    <p class='login_error'>Errore nell'eliminazione</p>
                 </div>";
?>
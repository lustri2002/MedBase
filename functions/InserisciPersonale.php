<?php
    /*
    * Il codice in questione prende i dati dal form, e per il privilegio esegue
    * una somma di tutti i privilegi impostati.
    * Una volta verificato che sia username e password siano uguali per tutti i campi
    * allora si procedere all'inserimento.
    */
    require "../protected/connessione.php";
    session_start();
    if(!(isset($_SESSION['utente_Medbase'])) or (($_SESSION['utente_Medbase']->privilegio & 16) == 0)){
        alert('Non consentito','../index.php');
        die();
    }
    $Username=$_POST['username'];
    $UsernameConfirm=$_POST['usernameConfirm'];
    $Password = $_POST['password'];
    $PasswordConfirm = $_POST['passwordConfirm'];
    $Privilegio =   (isset($_POST['analista']) ? $_POST['analista'] : 0) +
                    (isset($_POST['receptionist']) ? $_POST['receptionist'] : 0) +
                    (isset($_POST['medico']) ? $_POST['medico'] : 0) +
                    (isset($_POST['direttore']) ? $_POST['direttore'] : 0) +
                    (isset($_POST['amministratore']) ? $_POST['amministratore'] : 0);

    $sql = "select * from personale  where username='$Username'";
    $Result = mysqli_query($con, $sql);
    if($Result->num_rows === 0){
        if ($Username === $UsernameConfirm AND $Password === $PasswordConfirm){
            $Password = hash("sha512",$Password);
            $sql = "insert into personale (username, password, privilegio) values('$Username', '$Password', '$Privilegio')";
            if(mysqli_query($con, $sql)){
                header("location: ../GestioneUtenti.php");
            }
            else{
                alert("ERRORE","../GestioneUtenti.php");
            }
        }
        else{
            alert("Username o password non corrispondono","../GestioneUtenti.php");
        }
    }
    else{
        alert("Username già utilizzato","../GestioneUtenti.php");
    }

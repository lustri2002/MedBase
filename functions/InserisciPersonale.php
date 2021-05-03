<?php
    $Username=$_POST['username'];
    $UsernameConfirm=$_POST['usernameConfirm'];
    $Password = $_POST['password'];
    $PasswordConfirm = $_POST['passwordConfirm'];
    $Privilegio =   (isset($_POST['analista']) ? $_POST['analista'] : 0) +
                    (isset($_POST['receptionist']) ? $_POST['receptionist'] : 0) +
                    (isset($_POST['medico']) ? $_POST['medico'] : 0) +
                    (isset($_POST['direttore']) ? $_POST['direttore'] : 0) +
                    (isset($_POST['amministratore']) ? $_POST['amministratore'] : 0);
    require "../protected/connessione.php";
    $sql = "select * from personale where username='$Username'";
    $Result = mysqli_query($con, $sql);
    if($Result->num_rows === 0){
        if ($Username === $UsernameConfirm AND $Password === $PasswordConfirm){
            $sql = "insert into personale(username, password, privilegio) values('$Username', '$Password', '$Privilegio')";
            if(mysqli_query($con, $sql)){
                header("location: ../GestioneUtenti.php");
            }
            else{
                alert("ERRORE");
                header("refresh:3,url=../GestioneUtenti.php");
            }
        }
        else{
            alert("Username o password non corrispondono");
            header("refresh:3,url=../GestioneUtenti.php");
        }
    }
    else{
        alert("Username già utilizzato");
        header("refresh:3,url=../GestioneUtenti.php");
    }

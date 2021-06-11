<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/fcfff31d0b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script>$(function($){
            console.log($.ajax);
        });</script>
    <script src="js/main.js" type="text/javascript"></script>
    <title>MedBase</title>
    <link rel="icon" href="img/mb.png">
</head>
<body>
<?php
session_start();
?>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color" style="background-color: #4C258F">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="index.php" style="max-width: 200px; margin: 0; padding: 0; margin-right: 32px">
        <img class="logo"src="img/mb.png" style="max-width: 100%" >
    </a>

    <!-- Collapse button -->
    <button class="navbar-toggler toggler-width" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: #ffffff"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto na justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>


        </ul>
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                if(count($_SESSION) != 0){
                    echo '<div class="btn-group">
                              <button type="button" class="btn login_button">
                              '. $_SESSION['utente_Medbase']->username .'
                              </button>
                              <button type="button" class="btn dropdown-toggle dropdown-toggle-split login_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only"></span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">';
                                    if(($_SESSION['utente_Medbase']->privilegio & 1) > 0)
                                        echo '<a class="dropdown-item dropitem" href="Statistiche.php">Statistiche</a>';
                                    if(($_SESSION['utente_Medbase']->privilegio & 2) > 0)
                                        echo '<a class="dropdown-item dropitem" href="InserimentoPazienti.php">Inserimento paziente</a>';
                                    if(($_SESSION['utente_Medbase']->privilegio & 4) > 0)
                                        echo '<a class="dropdown-item dropitem" href="DimissionePazienti.php">Dimissione paziente</a>';
                                    if(($_SESSION['utente_Medbase']->privilegio & 8) > 0)
                                        echo '<a class="dropdown-item dropitem" href="GestioneReparti.php">Gestione reparti</a>';
                                    if(($_SESSION['utente_Medbase']->privilegio & 16) > 0)
                                        echo '<a class="dropdown-item dropitem" href="GestioneUtenti.php">Gestione utenti</a>';
                                    echo '
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item dropitem" onclick="document.getElementById(\'PasswordRecovery\').style.display=\'block\'">Modifica password</a>
                                                <div class="dropdown-divider"></div>                                                        
                                                <a class="dropdown-item logout_item" href="functions/logout.php" style="color: #B32100">Log-out</a>
                                      </div>
                                   </div>';
                }
                else
                    echo '<button class="nav-link login_button" onclick="document.getElementById(\'id01\').style.display=\'block\'" style="">Login</button>';
                ?>
            </li>
        </ul>
    </div>
    <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
<?php
require "protected/connessione.php";
    if(count($_SESSION) && ($_SESSION['utente_Medbase']->privilegio & 16) > 0){
        echo "  <div class='row'>
                    <div class='col-1'></div>
                    <div class='col-10' style='text-align: center'>
                        <div class='box' style='width: 100%'>
                            <table class='DefaultTable' style='text-align: left'>
                                <tr>
                                    <td rowspan='2' class='table_header' style='text-align: center'>Nome</td>
                                    <td colspan='5' class='table_header' style='text-align: center'>Privilegi</td>
                                </tr>
                                <tr>
                                    <td class='table_header' style='text-align: center'>Analista</td>
                                    <td class='table_header' style='text-align: center'>Receptionst</td>
                                    <td class='table_header' style='text-align: center'>Medico</td>
                                    <td class='table_header' style='text-align: center'>Direttore</td>
                                    <td class='table_header' style='text-align: center'>Gestore personale</td>                                    
                                </tr>";
                                $IdUtente = $_SESSION['utente_Medbase']->idP;
                                $sql = "select * from personale  where idP != $IdUtente";
                                $Result = mysqli_query($con, $sql);
                                while($row = $Result->fetch_object()){
                                    echo "
                                        <tr>
                                            <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'>$row->username</td>";
                                            if(($row->privilegio & 1)>0)
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(-1, $row->idP)' checked='checked'>
                                                    </td>";
                                            else
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(1, $row->idP)'>
                                                    </td>";
                                            if(($row->privilegio & 2)>0)
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' checked='checked' onclick='UpdatePrivilegi(-2, $row->idP)'>
                                                    </td>";
                                            else
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(2, $row->idP)'>
                                                    </td>";
                                            if(($row->privilegio & 4)>0)
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' checked='checked' onclick='UpdatePrivilegi(-4, $row->idP)'>
                                                    </td>";
                                            else
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(4, $row->idP)'>
                                                    </td>";
                                            if(($row->privilegio & 8)>0)
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' checked='checked' onclick='UpdatePrivilegi(-8, $row->idP)'>
                                                    </td>";
                                            else
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(8, $row->idP)'>
                                                    </td>";
                                            if(($row->privilegio & 16)>0)
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' checked='checked' onclick='UpdatePrivilegi(-16, $row->idP)'>
                                                    </td>";
                                            else
                                                echo "
                                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                                        <input type='checkbox' onclick='UpdatePrivilegi(16, $row->idP)'>
                                                    </td>";
                                    echo"
                                        <td style='border-left: 2px solid #150C25; background-color: #4C258F'>
                                            <button onclick='RimuoviAccount($row->idP)' style='background-color: transparent; width=auto; padding: 0; margin: 0'>
                                                <i class='far fa-trash-alt fa-2x remove_button'></i>
                                            </button>
                                        </td>
                                        </tr>";
                                }

                            echo "</table>
                        </div>
                    </div>
                    <div class='col-1'></div>
                </div>";

                echo "
                    <div class='row'>
                        <div class='col-lg-3 col-1'></div>
                        <div class='col-lg-6 col-10 box'>
                            <div style='padding-top: 15px'><h3>Nuovo account</h3></div>
                            <form method='post' action='functions/InserisciPersonale.php'>
                                <input type='text' name='username' required placeholder='Username' style='width: 40%'>
                                <input type='text' name='usernameConfirm' required placeholder='Conferma username' style='width: 40%'>
                                <input type='password' name='password' required placeholder='Password' style='width: 40%'>
                                <input type='password' name='passwordConfirm' required placeholder='Conferma password' style='width: 40%'>
                                <table class='DefaultTable' style='width: 80%'>
                                    <tr>
                                        <td colspan='5' class='table_header' style='text-align: center'>Privilegi</td>
                                    </tr>
                                    <tr>
                                        <td class='table_header' style='text-align: center'>Analista</td>
                                        <td class='table_header' style='text-align: center'>Receptionst</td>
                                        <td class='table_header' style='text-align: center'>Medico</td>
                                        <td class='table_header' style='text-align: center'>Direttore</td>
                                        <td class='table_header' style='border: 2px solid #150C25; text-align: center'>Gestore personale</td>                                    
                                    </tr>
                                    <tr>
                                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                            <input type='checkbox' name='analista' value='1'>
                                        </td>
                                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                            <input type='checkbox' name='receptionist' value='2'>
                                        </td>
                                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                            <input type='checkbox' name='medico' value='4'>
                                        </td>
                                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: center'>
                                            <input type='checkbox' name='direttore' value='8'>
                                        </td>
                                        <td class='table_content' style='border: 2px solid #150C25; text-align: center'>
                                            <input type='checkbox' name='amministratore' value='16'>
                                        </td>
                                    </tr>
                                </table>
                                <input type='submit' value='Aggiungi' style='width: 80%'>
                            </form>
                        </div>
                        <div class='col-lg-3 col-1'></div>    
                    </div>";
    }
    else echo "
                <div class='login_error_box'>  
                    <p class='login_error'>Accesso non consentito</p>
                </div>";
?>

<div id="id01" class="modal">

    <form class="modal-content animate" action="functions/LoginVerify.php" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img/medbase.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">

            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Inserisci Username" name="uname" id="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Inserisci Password" name="psw" id="password" required>

            <button class="loginbtn" type="submit">Login</button>
        </div>

        <div class="container" style="background-color:#1C1F1F">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>

        </div>
    </form>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<div id="PasswordRecovery" class="modal">
    <form class="modal-content animate" action="functions/UpdatePsw.php" method="post">
        <div class="container">
            <label for="oldpsw"><b>Inserisci la password attuale</b></label>
            <input type="password" placeholder="Inserisci password" name="oldpsw" id="oldpsw" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Nuova Password" name="psw" id="password" required>
            <input type="password" placeholder="Conferma Password" name="pswconfirm" id="passwordconfirm" required>
        </div>
        <div class="container" style="background-color:#1C1F1F">
            <button type="submit">Salva</button>
        </div>
    </form>
</div>


<div id="PasswordRecovery" class="modal">
    <form class="modal-content animate" action="functions/UpdatePsw.php" method="post">
        <div class="container">
            <label for="oldpsw"><b>Inserisci la password attuale</b></label>
            <input type="password" placeholder="Inserisci password" name="oldpsw" id="oldpsw" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Nuova Password" name="psw" id="password" required>
            <input type="password" placeholder="Conferma Password" name="pswconfirm" id="passwordconfirm" required>
        </div>
        <div class="container" style="background-color:#1C1F1F">
            <button type="submit">Salva</button>
        </div>
    </form>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('id01');
    var modal2 = document.getElementById('PasswordRecovery');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal || event.target == modal2) {
            modal.style.display = "none";
            modal2.style.display = "none";
        }
    }
</script>
</body>
</html>

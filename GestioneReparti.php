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
    <a class="navbar-brand" href="#" style="max-width: 200px; margin: 0; padding: 0; margin-right: 32px">
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
            <li class="nav-item">
                <a class="nav-link" href="#">Ospedali</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Dati</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>

        </ul>
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                if(count($_SESSION) != 0){
                    echo '<div class="btn-group">
                                      <button type="button" class="btn login_button">
                                      '. $_SESSION['utente']->username .'
                                      </button>
                                      <button type="button" class="btn dropdown-toggle dropdown-toggle-split login_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only"></span>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right">';
                    if(($_SESSION['utente']->privilegio & 1) > 0)
                        echo '<a class="dropdown-item dropitem" href="#">Statistiche - (1)</a>';
                    if(($_SESSION['utente']->privilegio & 2) > 0)
                        echo '<a class="dropdown-item dropitem" href="InserimentoPazienti.php">Inserimento paziente - (2)</a>';
                    if(($_SESSION['utente']->privilegio & 4) > 0)
                        echo '<a class="dropdown-item dropitem" href="#">Dimissione paziente - (4)</a>';
                    if(($_SESSION['utente']->privilegio & 8) > 0)
                        echo '<a class="dropdown-item dropitem" href="GestioneReparti.php">Gestione reparti - (8)</a>';
                    if(($_SESSION['utente']->privilegio & 16) > 0)
                        echo '<a class="dropdown-item dropitem" href="#">Gestione utenti - (16)</a>';
                    echo '<div class="dropdown-divider"></div>
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
    if(count($_SESSION) && ($_SESSION['utente']->privilegio & 8) > 0){
        $query = "SELECT * FROM Reparto";
        $result = mysqli_query($con, $query);
        echo '
        <div class="row">
            <div class="col-0 col-md-4"></div>
            <div class="box col-12 col-md-4" style="width: 30%">
                <div style="text-align: center">
                    <h3 style="padding-top: 15px">Reparti</h3>
                </div>
                <div style="margin-bottom: 2%">
                    <form action="functions/RimuoviReparti.php" method="post">
                        <table class="DefaultTable">
                            <tr>
                                <td class="table_header" style="border-right: none">Nome Reparto</td>
                                <td class="table_header" style="border-left: none">Posti letto</td>
                            </tr>';
                            while($row = $result->fetch_object()){
                                echo " 
                                <tr>
                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'>$row->NomeR</td>
                                    <td class='table_content' style='border-right: 2px solid #150C25'>$row->MaxPosti</td>
                                    <td style='background-color: #4C258F'>
                                        <button name='Remove'value='$row->idR' type='submit' style='background-color: transparent; width=auto; padding: 0; margin: 0'>
                                            <i class='far fa-minus-square fa-2x remove_button'></i>
                                        </button>
                                    </td>
                                </tr>";
                            } echo '                    
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-0 col-md-4"></div>
        </div>
        <div class="row" style="margin: 0">
            <div class="col-0 col-md-1"></div>
            <div class="box col-12 col-md-4">
                <div style="padding-top: 15px"><h3>Inserisci nuovo reparto</h3></div>
                <form action="functions/InserisciReparto.php" method="POST" style="height: 60%">
                    <input type="text" 
                           placeholder="Nome del reparto" 
                           name="nomeR" 
                           id="nomeR"
                           style="width: 45%"
                    >
                    <input type="number"
                           placeholder="Posti disponibili"
                           name="maxPosti"
                           id="maxPosti"
                           min="1"
                           style="width: 35%"                       
                    >
                    <input type="submit"
                           value="Aggiungi"
                           id="MaxPosti"
                           style="width: 80%"
                    >
                </form>
            </div>
            <div class="col-0 col-md-2"></div>
            <div class="box col-12 col-md-4">
                <div style="padding-top: 15px"><h3>Modifica</h3></div>
                <form action="functions/AggiornaReparto.php" method="POST" style="height: 60%">
                    <select class="select_box" name="idR">
                        <option value="0" disabled selected>Seleziona reparto</option>';
                        $sql="SELECT NomeR, idR From Reparto";
                        $listaReparti = mysqli_query($con, $sql);
                        while ($row = $listaReparti->fetch_object()){
                            echo"
                            <option value='$row->idR'>$row->NomeR</option>
                            ";
                        }
                    echo '</select>
                    <input type="number"
                           placeholder="Nuova capienza"
                           name="maxPosti"
                           id="maxPosti"
                           min="1"
                           style="width: 35%"                       
                    >
                    <input type="submit"
                           value="Salva"
                           id="MaxPosti"
                           style="width: 80%"
                    >
                </form>
            </div>
            <div class="col-0 col-md-1"></div>
        </div>';

    }
    else echo "
                 <div class='login_error_box'>  
                    <p class='login_error'>Accesso non consentito</p>
                 </div>"
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

            <button type="submit">Login</button>
        </div>

        <div class="container" style="background-color:#1C1F1F">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
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
<!-- jQuery and Bootstrap Bundle (includes Popper) -->

</body>
</html>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
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
                                            echo '<a class="dropdown-item dropitem" href="#">Inserimento paziente - (2)</a>';
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
    <div class="banner">
        <div class="banner_text">
            <h2>BANNER TITOLO</h2><br>
            <p>breve introduzione</p>
        </div>
        <div class="banner_image">
            <img src="img/homepage4.jpg" alt="">
        </div>
    </div>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
</body>
</html>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                      '. $_SESSION['utente']->username .'
                                      </button>
                                      <button type="button" class="btn dropdown-toggle dropdown-toggle-split login_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only"></span>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right">';
                                            if(($_SESSION['utente']->privilegio & 1) > 0)
                                                echo '<a class="dropdown-item dropitem" href="Statistiche.php">Statistiche</a>';
                                            if(($_SESSION['utente']->privilegio & 2) > 0)
                                                echo '<a class="dropdown-item dropitem" href="InserimentoPazienti.php">Inserimento paziente</a>';
                                            if(($_SESSION['utente']->privilegio & 4) > 0)
                                                echo '<a class="dropdown-item dropitem" href="DimissionePazienti.php">Dimissione paziente</a>';
                                            if(($_SESSION['utente']->privilegio & 8) > 0)
                                                echo '<a class="dropdown-item dropitem" href="GestioneReparti.php">Gestione reparti</a>';
                                            if(($_SESSION['utente']->privilegio & 16) > 0)
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
                            echo '<button class="nav-link login_button" onclick="document.getElementById(\'id01\').style.display=\'block\'">Login</button>';
                    ?>
                </li>
            </ul>
        </div>
        <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Benvenuti in MedBase</h1>
            <h2 style="">La piattaforma di gestione ospedaliera n. 1 sul mercato</h2>
        </div>
    </section>

    <main id="main">
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Perchè scegliere MedBase?</h3>
                            <p>
                                É una piattaforma facile, intuitiva e affidabile per la gestione di strutture ospedaliere,
                                anche polispecialistiche. <br>
                                Tiene traccia dei ricoveri di ogni paziente, in ogni singolo reparto. <br><br>
                                Basta fornire di un account ogni dipendente, dichiarare i suoi compiti ed il gioco è fatto!
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <span style="color: #006AB3">
                                            <i class="fas fa-lightbulb"></i>
                                        </span>
                                        <h4>Facile e intuitivo</h4>
                                        <p>Con la sua interfaccia utente MedBase è adatta a chiunque, anche se non si ha esperienza. </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <span style="color: #006AB3">
                                            <i class="fas fa-shield-alt"></i>
                                        </span>
                                        <h4>Affidabile e Sicuro</h4>
                                        <p>I dati vengono criptati prima di essere salvati in modo da garantirne la sicurezza.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <span style="color: #006AB3">
                                            <i class="fas fa-hands-helping"></i>
                                        </span>
                                        <h4>Assistenza 24/7</h4>
                                        <p>Per ogni problema il nostro team di assistenza interverrà per la risoluzione. Disponibile 365 giorni all'anno</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title" style="padding-bottom: 0">
                    <h2 style="color: #ffffff">Contattaci</h2>
                    <p>Se sei interessato a MedBase o intendi utilizzarlo nella tua struttura, utilizza il modulo qui sotto, <br>ti ricontatteremo noi entro 48h.</p>
                </div>
            </div>
            <div class="container">
                <div class="row mt-5" style="margin-top: 0 !important;">
                    <div class="col-lg-8 mt-5 mt-lg-0" style="margin: 0 auto">
                        <form action="functions/contatti.php" method="post" class="php-email-form">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Il tuo nome" required data-rule="minlen:4" data-msg="Almeno 4 caratteri" />
                                    <div class="validate"></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="La tua email" required data-rule="email" data-msg="Inserisci una mail valida" />
                                    <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Oggetto" required data-rule="minlen:4" data-msg="Almeno 4 caratteri" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="Messaggio" rows="5" required data-msg="Please write something for us" placeholder="Messaggio"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="text-center"><button type="submit" style="width: 50%; background-color: #4C258F">Invia messaggio</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section>
    </main>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 item">
                        <h3>ITI E.Medi</h3>
                        <ul>
                            <li>Via Buongiovanni, 84</li>
                            <li>San Giorgio a Cremano - 80046</li>
                            <li>Napoli, IT</li>
                        </ul>
                    </div>
                    <div class="col-lg-4 item social">
                        <a href="https://www.facebook.com/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/alelvstri" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com/alelvstri?igshid=jlrnj3eebxzt" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/public-profile/settings?trk=d_flagship3_profile_self_view_public_profile&lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_self_edit_top_card%3BOyXDy1NyT2eI2WYEPuiUCw%3D%3D" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 item text">
                        <h3>MedBase</h3>
                        <p>MedBase è un progetto sviluppato da Alessio Lustri nel 2021 senza alcuno scopo di lucro.</p>
                    </div>

                </div>
                <p class="copyright">MedBase © 2021</p>
            </div>
        </footer>
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
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" crossorigin="anonymous">
    <title>MedBase</title>
    <link rel="icon" href="img/mb.png">
</head>
<body>
<!--Navbar-->

    <nav class="navbar navbar-expand-lg navbar-dark primary-color" style="background-color: #4C258F">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.php" style="max-width: 200px; margin: 0; padding: 0; margin-right: 32px">
            <img class="logo"src="img/medbase.png" style="max-width: 100%" >
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation" style="width: 6%">
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
                    <button class="nav-link login_button" onclick="document.getElementById('id01').style.display='block'">Login</button>
                </li>
            </ul>
        </div>
        <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->
    <div class="container-group">
    <?php
        session_start();
        if($_SESSION['utente']->privilegio==2147483647)
            echo "<div class='container_single'>
                    <div><h3>Gestione reparti</h3></div>
                    <div><a class='button' href='index.php'></a></div>
                  </div>>";
        else
            echo"
                <div class='container_single'>
                    <div></div>
                </div>
                <div class='container_single'>
                    <div></div>
                </div>";
    ?>
    </div>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="LoginVerify.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img/medbase.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" id="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="password" required>

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
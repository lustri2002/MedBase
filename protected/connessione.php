<?php

define('NOMEDATABASE', 'medbase');
define('SERVERDATABASE', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');

$con = @ new mysqli (SERVERDATABASE, USERNAME, PASSWORD);

if ($con->connect_errno != 0)
{
    echo "<SCRIPT>alert('Connessione Server Fallita');</SCRIPT>";
}
else
    $con->select_db(NOMEDATABASE);
?>


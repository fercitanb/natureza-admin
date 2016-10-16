<?php
session_start();
if (isset ($_SESSION['loggedin'])) {
    unset($_SESSION['loggedin']);
}
session_destroy();
header("Location: ../vistas/ajax/login.html");
?>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["auth"]) || $_SESSION["auth"] != "1") {
        header("location: loginusuario.php");
        exit();
    }
?>

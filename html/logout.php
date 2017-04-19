<?php
    //PHP-Skript für Abmeldung
    session_start();
    session_destroy();
 
    //Umleitung auf Login-Seite
    header("Location: login.php");
?>

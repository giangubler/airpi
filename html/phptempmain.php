<?php
    //PHP-Skript um die aktuelle Lufttemperatur auszulesen
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=airpidb', 'root', 'airpidbmaster');

    $sql = "SELECT iddata, temp FROM data2 ORDER BY iddata DESC LIMIT 1";

    foreach ($pdo->query($sql) as $row) {
        echo $row['temp']." °C <br />";
    }
?>

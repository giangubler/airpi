<?php
    //PHP-Skript um Daten für den Luftfeuchtigkeits-Chart auszulesen
    require 'connection.php';

    $result = mysql_query("SELECT datetime, hour, hum FROM data WHERE datetime > DATE_SUB(NOW(), INTERVAL 24 HOUR) AND datetime <= NOW() AND hour IS NOT NULL ORDER BY datetime");

    $bln = array();
    $bln['name'] = 'Stunde';
    $rows['name'] = 'Luftfeuchtigkeit';
    while ($r = mysql_fetch_array($result)) {
        $bln['data'][] = $r['hour'];
        $rows['data'][] = $r['hum'];
    }
    $rslt = array();
    array_push($rslt, $bln);
    array_push($rslt, $rows);
    print json_encode($rslt, JSON_NUMERIC_CHECK);

    mysql_close($con);
?>
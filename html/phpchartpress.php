<?php
    //PHP-Skript um Daten für den Luftdrucks-Chart auszulesen
    require 'connection.php';

    $result = mysql_query("SELECT datetime, hour, press FROM data WHERE datetime > DATE_SUB(NOW(), INTERVAL 24 HOUR) AND datetime <= NOW() AND hour IS NOT NULL ORDER BY datetime");

    $bln = array();
    $bln['name'] = 'Stunde';
    $rows['name'] = 'Luftdruck';
    while ($r = mysql_fetch_array($result)) {
        $bln['data'][] = $r['hour'];
        $rows['data'][] = $r['press'];
    }
    $rslt = array();
    array_push($rslt, $bln);
    array_push($rslt, $rows);
    print json_encode($rslt, JSON_NUMERIC_CHECK);

    mysql_close($con);
?>
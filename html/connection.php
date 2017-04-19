<?php
    $con = mysql_connect("localhost","root","airpidbmaster");
	
    if (!$con) {
		 die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("airpidb", $con);
?>

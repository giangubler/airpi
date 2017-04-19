#!/bin/bash
echo Inserting data into DB AirpiDB

hour=$(date +"%H")

mysql -uroot -pairpidbmaster airpidb << EOF
	INSERT INTO data2 (datetime, temp, hum, press, mum, fkugel, dewpoint) VALUES (NOW(), '$1', '$2', '$3', '$4', '$5', '$6');
EOF

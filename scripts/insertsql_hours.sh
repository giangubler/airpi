#!/bin/bash
echo Inserting data into DB AirpiDB

hour=$(date +"%H")

mysql -uroot -pairpidbmaster airpidb << EOF
	INSERT INTO data (temp, hum, press, mum, fkugel, dewpoint, hour, datetime) VALUES ('$1', '$2', '$3', '$4', '$5', '$6', '$hour', NOW());
EOF

# airpi
IDPA airpi

This is a repository filled with all the files that I created for a school project.

The airpi is made up of a Raspberry Pi 3 and multiple sensors to get data about temperature, humidity and pressure.

Different files are included in different folders.

## requirements
The things you need to install are the following:
- apache2
- php5
- mysql-server

## html
This folder includes all the files needed for the webinterface to work. The files range from background to front php files.

Files needed for mysql connection:
- connection.php

Files needed for user interaction:
- login.php
- logout.php
- register.php

Files needed for the newest data:
- phptempmain.php
- phphummain.php
- phppressmain.php

Files needed for charts to work:
- phpcharttemp.php
- phpcharthum.php
- phpchartpress.php

Files needed for interface:
- temperaturen.php
- luftfeuchtigkeiten.php
- luftdruck.php

## scripts
This folder includes all the scripts needed for sensoring the data and inserting it into the mysql database. Those scripts are python and shell.

Files needed for reading data from sensors:
- readdata_hourly.py
- readdata_mins.py

Files needed for inserting into mysql:
- insertsql_hourly.sh
- insertsql_mins.sh

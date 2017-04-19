#!/usr/bin/python

import Adafruit_BMP.BMP085 as BMP085
sensor = BMP085.BMP085()
tempcalc = (sensor.read_temperature())
druck = (sensor.read_pressure())
hoehe = round(sensor.read_altitude(), 1)

import Adafruit_DHT
sensor = Adafruit_DHT.DHT22
pin = 22
humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
feuchte = round(humidity, 1)
		
if tempcalc < 5:
	fkugel1 = 0 - 5.803 
	fkugel2 = (0.058)*feuchte 
	fkugel3 = (0.697)*tempcalc
	fkugel4 = (0.003)*feuchte*tempcalc
	fkugel =  fkugel1 + fkugel2 +fkugel3 + fkugel4
else:
	fkugel = 2
	dewpoint = 2

import subprocess

command = "/airpi/insertsql_mins.sh " + str(tempcalc) + " " + str(feuchte) + " " + str(druck) + " " + str(hoehe) + " " + str(fkugel) + " " + str(dewpoint)

subprocess.call(command,  shell=True)



#import MySQLdb

	#db = MySQLdb.connect(host="localhost",
		    # user="airdbuser",
	       	 #    passwd="apdbuser",
		     #db="airpidb")

	#cur = db.cursor()

	#cur.execute("INSERT INTO data3 (datetime, temp, hum, press, mum, fkugel, dewpoint) VALUES (NOW(), '%s', '%s', '%s', '%s', '%s', '%s')" % (tempcalc, feuchte, druck, hoehe, fkugel, dewpoint))

	#cur.close()
	#db.commit()
	#db.close()

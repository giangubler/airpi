<?php
    //PHP-Skript für Session
    session_start();
    if(!isset($_SESSION['userid'])) {
	   header("Location: login.php");
    }
 
    //Abfrage der User-ID vom Login
    $userid = $_SESSION['userid'];
 
    echo "Hallo User: ".$userid;
?>

<?php
    //PHP-Skript für Reload
    $page = $_SERVER['PHP_SELF'];
    $sec = "600";
?>

<html>
    <head>
        <title>AirPi - Temperatur</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <meta http-equiv="refresh" content=<?php echo $sec?>;URL='<?php echo $page?>'>	
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'temperatur',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafische Darstellung der Temperaturen',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Source: AirPi',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Stunde'
                        },
                    },
                    yAxis: {
                        title: {
                            text: 'Temperatur in °C'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: '°C'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: []
                };
                $.getJSON("phpcharttemp.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
            });
        </script>	
        
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">AirPi</a>
                </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="temperaturen.php">Temperatur</a></li>
                        <li><a href="luftfeuchtigkeiten.php">Luftfeuchtigkeit</a></li>
                        <li><a href="luftdruck.php">Luftdruck</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	<li><form action="register.php"><input type="submit" class="btn btn-default navbar-btn" value="Benutzerregistrierung" /></form></li>
                    	<li><form action="logout.php"><input type="submit" class="btn btn-default navbar-btn" value="Abmelden" /></form></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="container">
            <h1>Temperatur</h1>
            <hr>
            <p>Auf dieser Seite wird die momentane Temperatur sowie deren Verlauf angezeigt.</p>
            
	    	<div class="col-md-12">
	    		<div class="jumbotron">
            		<h3>Temperatur:</h3>
	    			<h4> <?php include ("phptempmain.php"); ?> </h4>
	    		</div>
	    	</div>

	    	<div class="col-md-12">
            	<div id="temperatur" style="width:100%; height:400px;"></div>
            </div>
	
            </br>

        </div>
        
        
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> 
    
    </body>

</html>

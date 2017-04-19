<?php
    //PHP-Skript für Sessions
    session_start();

    //Wenn noch keine Session existiert, wird der Benutzer auf die Login-Seite weitergeleitet
    if(!isset($_SESSION['userid'])) {
	   header("Location: login.php");
    }
 
    //Abfrage der User-ID vom Login
    $userid = $_SESSION['userid'];
 
    echo "Hallo User: ".$userid;
?>

<?php
    //PHP-Skript für DB-Verbindung
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=benutzer', 'root', 'airpidbmaster');
?>

<html>
    <head>
        <title>AirPi - Register</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <meta http-equiv="refresh" content=<?php echo $sec?>;URL='<?php echo $page?>'>	

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
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
                        <li><a href="temperaturen.php">Temperatur</a></li>
                        <li><a href="luftfeuchtigkeiten.php">Luftfeuchtigkeit</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	<li><form action="register.php"><input type="submit" class="btn btn-default navbar-btn" value="Benutzerregistrierung" /></form></li>
                    	<li><form action="logout.php"><input type="submit" class="btn btn-default navbar-btn" value="Abmelden" /></form></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="container">
            <h1>Registration</h1>
            <hr>
            <p>Legen Sie hier ein neues Benutzerkonto an.</p>
	    	</br>

			<?php
                //PHP-Skript zur Benutzererstellung
				$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
				if(isset($_GET['register'])) {
 					$error = false;
 					$email = $_POST['email'];
 					$passwort = $_POST['passwort'];
 					$passwort2 = $_POST['passwort2'];
  
 					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 						echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
 						$error = true;
 					} 
 					if(strlen($passwort) == 0) {
 						echo 'Bitte ein Passwort angeben<br>';
 						$error = true;
 					}
 					if($passwort != $passwort2) {
 						echo 'Die Passwörter müssen übereinstimmen<br>';
 						$error = true;
 					}
 
 					//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 					if(!$error) { 
 						$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 						$result = $statement->execute(array('email' => $email));
 						$user = $statement->fetch();
 
 						if($user !== false) {
 							echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 							$error = true;
 						} 
 					}
 
 					//Keine Fehler, wir können den Nutzer registrieren
 					if(!$error) { 
 						$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
 						$statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
 						$result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));
 
 						if($result) { 
 							header("Location: index.php");
 						} else {
 							echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 						}
 					} 
				}
 
				if($showFormular) {
			?>
 
			<form action="?register=1" method="post">
				E-Mail:<br>
				<input type="email" size="40" maxlength="250" name="email"><br><br>
 
				Passwort:<br>
				<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
				Passwort wiederholen:<br>
				<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
 
				<input type="submit" value="Abschicken">
			</form>
 
			<?php
				} //Ende von if($showFormular)
			?>

        </div>
        
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    </body>

</html>

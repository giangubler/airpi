<?php
    //PHP-Skript für Sessions
    session_start();
    //Herstellung der DB-Verbindung
	$pdo = new PDO('mysql:host=localhost;dbname=benutzer', 'root', 'airpidbmaster');
 
	if(isset($_GET['login'])) {
        $email = $_POST['email'];
 		$passwort = $_POST['passwort'];
 
 		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 		$result = $statement->execute(array('email' => $email));
 		$user = $statement->fetch();
 
 		//Überprüfung des Passworts
 		if ($user !== false && password_verify($passwort, $user['passwort'])) {
 			$_SESSION['userid'] = $user['id'];

 			header("Location: index.php");
 		} else {
 			$errorMessage = "E-Mail oder Passwort ist ungültig.<br>";
 		}
	}
?>

<html>
    <head>
        <title>AirPi - Login</title>
        
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
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="container">
            <h1>Login</h1>
            <hr>
            <p>Bitte melden Sie sich mit Ihrer E-Mail und Kennwort an.</p>
            </br>

			<?php 
				if(isset($errorMessage)) {
 					echo $errorMessage;
				}
			?>
 
			<form action="?login=1" method="post">
                E-Mail:<br>
                <input type="email" size="40" maxlength="250" name="email"><br><br>
 
				Passwort:<br>
				<input type="password" size="40"  maxlength="250" name="passwort"><br><br>
 
				<input type="submit" value="Anmelden">
			</form>

        </div>
        
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>    
    
    </body>

</html>

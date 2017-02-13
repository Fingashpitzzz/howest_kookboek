<html>
    <link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<?php session_start();
			if (!isset($_SESSION["gebruikersnaam"])){
				$tekst = "<h2>U bent nog niet aangemeld.</h2>
					U kunt zich <a href=\"../registreren/registreer.php\">hier</a> registeren.
					Indien dit al gebeurt is, kunt u <a href=\"../inloggen/login.php\">hier</a> inloggen. ";
					echo($tekst);
					exit();
			}
			else{
				echo("U bent ingelogd");
			}
		?>
	</body>
</html>
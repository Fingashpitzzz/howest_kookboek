<html>
    <link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<?php session_start();
			if (!isset($_SESSION["gebruikersnaam"])){
				$tekst = "<h2>U bent nog niet aangemeld.</h2>
					U kunt zich <a href=\"../praktisch/registreren/registreer.php\">hier</a> registeren. Indien dit al gebeurt is, kunt u  <a href=\"../praktisch/inloggen/login.php\">hier</a> inloggen. ";
					echo($tekst);
					exit();
			}
			else{
				echo"Welkom, ". $_SESSION["gebruikersnaam"];
			}
		?>
	</body>
</html>
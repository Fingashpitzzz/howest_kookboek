<html>
    <link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<?php session_start();
			if (!isset($_SESSION["gebruikersnaam"])){
				$tekst = "<h2>U bent nog niet aangemeld.</h2>
					U kunt <a href=\"login.php\">hier</a> inloggen of<br>
					u kunt zich <a href=\"../register.php\">hier</a> registeren. ";
					echo($tekst);
					exit();
			}
			else{
				echo"Welkom, ". $_SESSION["gebruikersnaam"];
				$gebruikersnaam = $_SESSION["gebruikersnaam"];

			}
		?>
	</body>
</html>
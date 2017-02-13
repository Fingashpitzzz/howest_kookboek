<?php
	session_start();
?>

<html>
	<head>
		<title>Beveiligde pagina</title>
	</head>

	<link type="text/css" rel="stylesheet" href="../../opmaak.css" />
		<?php 
			if (!isset($_SESSION["gebruikersnaam"])){
				$tekst = "<h2>U bent nog niet aangemeld.</h2>
					U kunt <a href=\"login.php\">hier inloggen</a> of<br>
					U kunt zich <a href=\"../registreer.php\">hier registreren</a>";
				echo($tekst);
			}else{?>
			
			<h2>Welkom op deze beveiligde pagina</h2>
			
			U bent aangemeld als :	<?php echo($_SESSION["gebruikersnaam"]);?> <br>
			Uw wachtwoord is : <?php echo($_SESSION["wachtwoord"]);?> <br>
			<hr>
			<a href="../../aangemeld/links2.php" target="links" onClick="parent.rechts.location.href='../../aangemeld/home2.php';">verder</a>
			<?php
			}
		?> 
	</body>
</html>
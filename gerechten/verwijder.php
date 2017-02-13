<?php
	include("inc_connect_mysql.php");
	
	// controleren of pagina zichzelf heeft aangeroepen
	// via hidden-field uit het formulier
	if (isset($_POST["bevestiging"])){
		$query="DELETE FROM gerechten WHERE id=" .$_POST["id"];
		$result = mysql_query($query) or die ();
		echo("De opdracht is uitgevoerd!<br>\n");
		if ($result){
			echo ("<a href=\"../gebruiker/profiel.php\">Terug naar uw profiel</a>");
		}
	}else{
		// pagina heeft zichzelf nog niet aangeroepen, 
		// eerst om bevestiging vragen
		$query="SELECT * FROM gerechten WHERE id=" .$_GET["id"];
		$result = mysql_query($query) or die ();
?>

<html>
	<head>
		<title>Verwijderen: weet u het zeker?</title>
	</head>

    <link type="text/css" rel="stylesheet" href="opmaak.css" />
		<h2>Let op: wilt u deze gegevens verwijderen?</h2>
		<?php
		while ($rij = mysql_fetch_array($result)){
			echo("Naam = ". $rij['naam'] . "<br>\n");
			echo("Categorie = ". $rij['categorie'] . "<br>\n");
			echo("Soort = ". $rij['soort']  . "<br><hr>\n");
		}?>
		<form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="post">
			<input type="hidden" name="bevestiging" value="1">
			<input type="hidden" name="id" value="<?php echo($_GET["id"]);?>">
			<input type="Submit" value="Ja, verwijderen">
		</form>
		<?php
			}
		?>
	</body>
</html>

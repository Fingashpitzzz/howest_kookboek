<?php include("inc_logged_in.php") ?>

<html>
	<head>
		<title>Zoeken</title>
	</head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<h2>U kunt hier zoeken op naam, categorie, soort of ingrediënten van het gerecht:</h2>
		<form action="zoekresultaat.php" method="post">
			<input type="text" name="trefwoord" value="" size="30"><br>
			<input type="Radio" name="zoeken" value="naam"> Naam 
			<input type="Radio" name="zoeken" value="categorie"> Categorie 
			<input type="Radio" name="zoeken" value="soort"> Soort
			<input type="Radio" name="zoeken" value="ingredient"> Ingrediënten
			<hr>
			<input type="Submit" value="Zoeken">
		</form>
	</body>
</html>
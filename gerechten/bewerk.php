<?php
	// verbinding met database invoegen
	include("inc_connect_mysql.php");
	
	// controleren of pagina zichzelf heeft aangeroepen
	// via hidden-field uit het formulier
	if (isset($_POST["bevestiging"])){
		// query samenstellen
		$query="UPDATE gerechten SET 
			naam = '". $_POST["naam"] ."',
			categorie = '". $_POST["categorie"] ."', 
			soort = '". $_POST["soort"] . "', 
			ingredient = '". $_POST["ingredient"] . "'
			WHERE id=" .$_POST["id"];
		$result = mysql_query($query) or die ();
		echo("De opdracht is uitgevoerd.<br>\n");
		if ($result){
			echo ("<a href=\"../gebruiker/profiel.php\">Terug naar uw profiel.</a>");
		}
	}else{
		// pagina heeft zichzelf nog niet aangeroepen, 
		// formulier tonen om gegevens te bewerken
			$query="SELECT * FROM gerechten WHERE id=" . $_GET["id"];
			$result = mysql_query($query) or die ();
?>

<html>
	<head>
		<title>Bewerken: wijzig de gegevens</title>
	</head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<h2>Wijzig deze gegevens:</h2>

		<?php
			// gegevens ophalen en toekennen aan tijdelijke variabelen
			while ($rij = mysql_fetch_array($result)){
				$vn = $rij['naam']; 
				$kmr = $rij['categorie'];
				$tsl = $rij['soort'] ;
				$ing = $rij['ingredient'] ;
		}?>

		<form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="post">
			
			
			<table border="0" cellpadding="0" cellspacing="0" width="300">
				<tr>
					<td>
						<fieldset>
							<table border="0" cellpadding="0" cellspacing="3" width="100%">
								<input type="hidden" name="bevestiging" value="1">
								<input type="hidden" name="id" value="<?php echo($_GET["id"]);?>">
								
								<tr>
									<td width="33%">Naam:</td>
									<td width="67%"><input type="text" name="naam"value="<?php echo($vn);?>" size="30"><br></td>
								</tr>
								<tr>
									<td width="33%">Categorie:</td>
									<td width="67%"><input type="text" name="categorie" value="<?php echo($kmr);?>" size="30"><br></td>
								</tr>
								<tr>
									<td width="33%">Soort:</td>
									<td width="67%"><input type="text" name="soort" value="<?php echo($tsl);?>" size="30""><br></td>
								</tr>
								<tr>
									<td width="33%">Ingrediënten:</td>
									<td width="99%"><input type="text" name="ingredient" value="<?php echo($ing);?>" size="30""><br></td>
								</tr>
								<tr>
							</table>	
						</fieldset>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="Submit" value="Bijwerken">
					</td>
				</tr>
			</table>
		</form>
		<?php
			}
		?>
	</body>
</html>

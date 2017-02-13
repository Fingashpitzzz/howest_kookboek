<?php include("inc_logged_in.php") ?>
<?php 
	include("../databaseconnecties/inc_connect_mysql.php");
	$sql= "SELECT * FROM gerechten WHERE soort='hoofdgerecht' ORDER BY 'naam';";
	$result= mysql_query($sql);
?>

<html>
    <head>
        <title>Hoofdgerechten</title>
    </head>

    <link type="text/css" rel="stylesheet" href="../opmaak.css" />
        <h2>Hoofdgerechten</h2>
        <p>Welkom bij onze aperitiefhapjes,</br>
            Hier vindt u de ideale aperitiefhapjes voor een geslaagde avond. U kunt zelf uw eigen creatie delen met ons via uw profielpagina.</p>
        <img border="0" src="../afbeeldingen/hoofdgerecht.jpg" height="200"/>
        <br><br>
		<!-- eerst de kolomkoppen voor de tabel in plain HTML schrijven -->
		<table border="1" width="100%" align="left">
			<tr>
            	<th width="50">Naam</th>
            	<th width="20">Categorie</th>
            	<th width="20">Soort</th>
            	<th width="300">Ingrediënten</th>
            	<th width="20">Bereidingstijd</th>
            	<th width="300">Bereiding</th>
			</tr>
			<!-- Vanaf hier de PHP while()-lus. Elke lusdoorgang schrijft
				een tabelrij naar het scherm -->
			<?php while ($rij = mysql_fetch_array($result)){
					echo ("<tr valign=top>" .
						"<td>" . $rij['naam'] . " </td> " .
						"<td>" . $rij['categorie'] . " </td> " .
						"<td>" . $rij['soort'] . " </td>".
						"<td>" . $rij['ingredient'] . " </td>".
						"<td>" . $rij['bereidingstijd'] . " </td>".
						"<td>" . $rij['bereiding'] . " </td>".
						"</td></tr>\n ");
				}
			?>
		</table>
	</body>
</html>
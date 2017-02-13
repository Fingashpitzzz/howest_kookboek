<?php
    include("../aangemeld/inc_logged_in.php")
?>
<?php 
	include("../databaseconnecties/inc_connect_mysql.php");
	$sql= "SELECT * FROM gerechten WHERE gebruikersnaam = '$gebruikersnaam' ORDER BY id;";
	$result= mysql_query($sql);
?>

<html>
    <head>
        <title>Uw profiel</title>
    </head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />

        <p>In onderstaande tabel vindt u alle gerechten die u toegevoegd hebt. U kunt deze nu aanpassen of verwijderen.</p>
        <p>U kunt ook een <a href="../gerechten/recept invoegen.php">gerecht toevoegen </a></p>
        <!-- eerst de kolomkoppen voor de tabel in plain HTML schrijven -->
        <table border="1" width="100%" align="center">
            <tr>
            	<td colspan="8"><h2 align="center">Gerechten</h2></td>
            </tr>
            <tr>
            	<th width="100">Naam</th>
            	<th width="100">Categorie</th>
            	<th width="100">Soort</th>
            	<th width="300">Bereiding</th>
            	<th width="150">Bereidingstijd</th>
            	<th width="300">Ingrediënten</th>
            	<th width="50">Verwijderen</th>
            	<th width="50">Bewerken</th>
            </tr>
            <!-- Vanaf hier de PHP while()-lus. Elke lusdoorgang schrijft
            	een tabelrij naar het scherm -->
            <?php while ($rij = mysql_fetch_array($result)){
					echo ("<tr valign=top>" .
            			"<td>" . $rij['naam'] . " </td> " .
            			"<td>" . $rij['categorie'] . " </td> " .
            			"<td>" . $rij['soort'] . " </td>".
            			"<td>" . $rij['bereiding'] . " </td>".
            			"<td>" . $rij['bereidingstijd'] . " </td>".
            			"<td>" . $rij['ingredient'] . " </td>".
            			"<td><center><a href=\"../gerechten/verwijder.php ?id=" . $rij['id'] ."\"><img src=\"../afbeeldingen/verwijder.jpg\" WIDTH=\"20\" ></a></center></td>" .
            			"<td><center><a href=\"../gerechten/bewerk.php    ?id="    . $rij['id'] ."\"><img src=\"../afbeeldingen/bewerk.jpg\"    WIDTH=\"20\" ></a></center>" .
            			"</td></tr>\n ");
            	}
            ?>
        </table>
        <hr>
    </body>
</html>
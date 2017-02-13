<?php 
include("inc_connect_mysql.php");
$sql= "SELECT * FROM gerechten ORDER BY naam;";
$result= mysql_query($sql);

?>

<html>
<head>
<title>Uw gerechten</title>
</head>
<body style="background: white; color: black; font-family: comic sans ms; text-align:center">
<body>
<p>In onderstaande tabel vindt u alle gerechten die u toegevoegd hebt. U kunt deze nu aanpassen of verwijderen.</p>
<!-- eerst de kolomkoppen voor de tabel in plain HTML schrijven -->
<table border="1" width="80%" align="center">
<tr>
	<td colspan="6"><h2 align="center">Gerechten</h2></td>
</tr>
<tr>
	<th width="300">Naam</th>
	<th width="200">Categorie</th>
	<th width="200">Soort</th>
	<th width="100">Verwijderen</th>
	<th width="100">Bewerken</th>
</tr>
<!-- Vanaf hier de PHP while()-lus. Elke lusdoorgang schrijft
	een tabelrij naar het scherm -->
<?php while ($rij = mysql_fetch_array($result)){
		echo ("<tr>" .
			"<td>" . $rij['naam'] . " </td> " .
			"<td>" . $rij['categorie'] . " </td> " .
			"<td>" . $rij['soort'] . " </td>".
			"<td><center><a href=\"verwijder.php?id=" . $rij['id'] ."\"><img src=\"verwijder.jpg\" WIDTH=\"20\" ></a></center></td>" .
			"<td><center><a href=\"bewerk.php?id=" . $rij['id'] ."\"><img src=\"bewerk.jpg\" WIDTH=\"20\" ></center></a>" .
			"</td></tr>\n ");
	}
?>
</table>
<hr>
</body>
</html>
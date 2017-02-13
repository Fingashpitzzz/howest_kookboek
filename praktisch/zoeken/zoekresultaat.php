<?php
    // verbinding met database invoegen
    include("../../databaseconnecties/inc_connect_mysql.php");

    if (!empty($_POST["zoeken"])){
	$query="SELECT * FROM gerechten WHERE " . $_POST["zoeken"] . "";
	switch ($_POST["zoeken"]){
		case "naam":
				$query .= " LIKE '%" . $_POST["trefwoord"] . "%'";
				break;
		case "categorie":
				$query .= " LIKE '%" . $_POST["trefwoord"] . "%'";
				break;
		case "soort":
				$query .= " LIKE '%" . $_POST["trefwoord"] . "%'";
				break;
		case "ingredient":
				$query .= " LIKE '%" . $_POST["trefwoord"] . "%'";
				break;
		default:
			break;
	}
	$result = mysql_query($query) or die ();
	$aantal = mysql_num_rows($result);
    }else{
	//eventueel statements indien pagina niet correct werd aangeroepen
    }	
?>

<html>
	<head>
		<title>Zoekresultaten</title>
	</head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<?php
			// controleer eerst of er records werden gevonden
			if ($aantal == 0){
				echo ("Helaas, er werden geen gerechten gevonden 
					met <b> ". $_POST["trefwoord"]. " </b><br>\n");
			}else{
				echo("<b>Er werden $aantal gerechten gevonden:</b><br>");
				while ($rij = mysql_fetch_array($result)){
					echo("Naam = ". $rij['naam'] . "<br>\n");
					echo("Categorie = ". $rij['categorie'] . "<br>\n");
					echo("Soort = ". $rij['soort']  . "<br><hr>\n");
					//echo("Ingrediënten = ". $rij['ingredient']  . "<br><hr>\n");
				}
			}
		?>
		<br>
	</body>
</html>

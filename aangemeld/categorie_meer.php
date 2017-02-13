<?php include("inc_logged_in.php") ?>
<?php 
	include("../databaseconnecties/inc_connect_mysql.php");
	$sql= "SELECT * FROM categorie ORDER BY naam;";
	$result= mysql_query($sql);
?>

<html>
    <head>
        <title>Soorten gerechten</title>
    </head>

    <link type="text/css" rel="stylesheet" href="../opmaak.css" />
        <h2>Soorten gerechten</h2>
        <p>Hier vindt u een uitgebreid overzicht van alle gerechtcategorieën op deze website. </p>
		<!-- Vanaf hier de PHP while()-lus. Elke lusdoorgang schrijft
			een tabelrij naar het scherm -->
		<ul>
            <?php while ($rij = mysql_fetch_array($result)){
            		echo ("<tr>" .
            			"<li>" . $rij['naam'] . " </li> " .
            			"\n ");
            	}
            ?>
        </ul>
	</body>
</html>
<?php 
// variabelen initialiseren:
// $username = "gebruikersnaam";
// $password = "wachtwoord";
$host="localhost";
$username="root";
$dbnaam="kookboek";
$db=mysql_connect($host, $username) or die (mysql_error());
mysql_select_db($dbnaam, $db) or die (mysql_error());
?>
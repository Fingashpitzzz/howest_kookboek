<?php
    ob_start();
    $host="localhost"; // Host name 
    $username="root"; // Mysql username 
    $password=""; // Mysql password 
    $db_name="kookboek"; // Database name 
    $tbl_name="accounts"; // Table name 

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");

    // Define $gebruikersnaam and $wachtwoord 
    $gebruikersnaam=$_POST['gebruikersnaam']; 
    $wachtwoord=$_POST['wachtwoord']; 

    // To protect MySQL injection (more detail about MySQL injection)
    $gebruikersnaam = stripslashes($gebruikersnaam);
    $wachtwoord = stripslashes($wachtwoord);
    $gebruikersnaam = mysql_real_escape_string($gebruikersnaam);
    $wachtwoord = mysql_real_escape_string($wachtwoord);

    $sql="SELECT * FROM $tbl_name WHERE gebruikersnaam='$gebruikersnaam' and wachtwoord='$wachtwoord'";
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);
    // If result matched $gebruikersnaam and $wachtwoord, table row must be 1 row

    if($count==1){
        // Register $gebruikersnaam, $wachtwoord and redirect to file "login_success.php"
        session_register("gebruikersnaam");
        session_register("wachtwoord"); 
        header("location:beveiligd.php");
    }
    else
    {
        echo "Oeps! Foutje!";
    }

    ob_end_flush();
?>

<html>
	<head>
		<title>Inloggen</title>
	</head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />
		<h2>Inloggen:</h2>
		<hr>
		<form name="form1" method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
			<table border="0" cellpadding="0" cellspacing="0" width="300">
				<tr>
					<td>
						<fieldset>
							<table border="0" cellpadding="0" cellspacing="3" width="100%">
								<tr>
									<td width="33%">Gebruikersnaam:</td>
									<td width="67%"><input name="gebruikersnaam" style="width: 99%" type="text"><br></td>
								</tr>
								<tr>
									<td width="33%">Wachtwoord: </td>
									<td width="67%"><input name="wachtwoord" style="width: 99%" type="password"><br></td>
								</tr>
							</table>	
						</fieldset>
					</td>
				</tr>
				<tr>
					<td align="right"><br>
						<input type="submit" name="Submit" value="Inloggen">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
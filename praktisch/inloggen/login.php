<?php
	session_start();
	if (!empty($_POST)){
		// Of korter genoteerd: 
		$_SESSION["gebruikersnaam"] = $_POST["gebruikersnaam"];
		$_SESSION["wachtwoord"] = $_POST["wachtwoord"];
		// doorsturen naar beveiligde pagina
		header("Location: beveiligd.php");
	}
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
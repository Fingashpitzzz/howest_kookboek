<html>
<body>

<?php

//provincies en landen uit de database halen
            // Constanten voor mysql_connect() insluiten:
            require_once('../../databaseconnecties/mysql_connect.inc.php');
            // Databaseverbinding openen en database selecteren:
            $verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysql_error());
            mysql_select_db("kookboek") or die(mysql_error());
            
            $sql3="SELECT id, provincie FROM provincies ";
            $resultaatprovincie=mysql_query($sql3);
            
            $optionprovincie="";
            
            while ($row=mysql_fetch_array($resultaatprovincie)) {
            
                $id=$row["id"];
                $provincie=$row["provincie"];
                $optionprovincie.="<OPTION VALUE=\"$provincie\">".$provincie.'</option>';
            } 
            
            $sql4="SELECT id, naam FROM landen ";
            $resultaatland=mysql_query($sql4);
            
            $optionland="";
            
            while ($row=mysql_fetch_array($resultaatland)) {
            
                $id=$row["id"];
                $land=$row["naam"];
                $optionland.="<OPTION VALUE=\"$land\">".$land.'</option>';
            }
            
// Formulier lezen en controleren:
if (isset($_POST['submit'])) {
    $gebruikersnaam       = trim($_POST['gebruikersnaamn']);
    $wachtwoord           = trim($_POST['wachtwoord']);
    $wachtwoord_bevestigd = trim($_POST['wachtwoordbevestigd']);

    $melding = ""; // String voor (fout)meldingen


    if (strlen($gebruikersnaam) < 3) {
        $melding .= "De gebruikersnaam moet minimaal 3 tekens lang zijn. ";
    }

    if (strlen($wachtwoord) < 6) {
        $melding .= "Het wachtwoord moet minimaal 6 tekens lang zijn. ";
    }

    if ($gebruikersnaam == $wachtwoord) {
        $melding .= "De gebruikersnaam mag niet hetzelfde zijn als het wachtwoord. ";
    }

    if ($wachtwoord != $wachtwoord_bevestigd) {
        $melding .= "U hebt twee verschillende wachtwoorden ingevoerd. ";
    }

    if (isset($_POST['geslacht'])) {
        $geslacht = $_POST['geslacht'];
        if (!$geslacht == 0 or !$geslacht == 1) {
            if ($geslacht == 0){
                $geslachten = "Vrouw";
            }
            else{
                $geslachten = "Man";
            }
        }
    } else {
        $geslacht = "";
    }

    // Overige gebruikersgegevens lezen:
    $voornaam   = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $woonplaats = $_POST['woonplaats'];
    $emailadres = $_POST['emailadres'];
    $provincie  = $_POST['provincie'];
    $land       = $_POST['land'];

    // Databaseverbinding pas openen als er geen foutmeldingen zijn:
    if ($melding == "") {
        // Eerst controleren of de gebruikersnaam al bestaat ...
        $sql1  = "SELECT `gebruikersnaam` FROM `accounts` ";
        $sql1 .= "WHERE `gebruikersnaam` = '$gebruikersnaam'";
        // ... en daarna eventueel een nieuwe account toevoegen:
        $sql2  = "INSERT INTO `accounts` (`gebruikersnaam`, `wachtwoord`, `geslacht`, `voornaam`, `achternaam`, `woonplaats`, `provincie`, `land`, `email`) ";
        $sql2 .= "VALUES (";
        $sql2 .= "'$gebruikersnaam', '$wachtwoord', '$geslachten', '$voornaam', '$achternaam', '$woonplaats', '$provincie', '$land', '$emailadres'";
        $sql2 .= "); ";

        // Constanten voor mysql_connect() insluiten:
        require_once('../../databaseconnecties/mysql_connect.inc.php');
        // Databaseverbinding openen en database selecteren:
        $verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysql_error());
        mysql_select_db("kookboek") or die(mysql_error());
        // De eerste query uitvoeren:
        $resultaat = mysql_query($sql1) or die(mysql_error());
        // De tweede query uitvoeren als de gebruikersnaam niet is gevonden:
        if (mysql_num_rows($resultaat) == 0) {
            mysql_free_result($resultaat);
            mysql_query($sql2) or die(mysql_error());
            mysql_close($verbinding);
            // Succesvolle registratie melden:
            if (!headers_sent()) {
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            }
            echo "<h2>Account toegevoegd</h2>\n";
            echo "<p>Er is een nieuwe account met de gebruikersnaam <strong>$gebruikersnaam</strong> toegevoegd. U kunt zich nu aanmelden.</p>";
            exit;
        } else {
            mysql_free_result($resultaat);
            mysql_close($verbinding);
            $melding .= "De gebruikersnaam <strong>$gebruikersnaam</strong> lijkt te veel op een andere gebruikersnaam. ";
            $gebruikersnaam = "";
        }
    }


} else {
    // Standaardtekst voor de instructies:
    $melding  = "Met het onderstaande formulier kunt u een nieuwe account openen.
                    Typ eerst een gebruikersnaam en een wachtwoord in het vak Gebruikersaccount.
                    Typ daarna uw persoonlijke gegevens in het vak Gebruikersgegevens. ";

    // Lege formuliervelden:
    $gebruikersnaam     = "";
    $geslacht           = "";
    $voornaam           = "";
    $achternaam         = "";
    $woonplaats         = "";
    $emailadres         = "";
}

// HTTP-headers toevoegen:
if (!headers_sent()) {
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
}

?>
<link type="text/css" rel="stylesheet" href="../opmaak.css" />
<h2>Registratie</h2>
<p><?php echo $melding; ?></p>
<form action="registreer.php" method="post">
  <table border="0" cellpadding="0" cellspacing="0" width="400">
    <tr>
      <td>
        <fieldset>
          <legend><h3>Gebruikersaccount</h3></legend>
          <table border="0" cellpadding="0" cellspacing="3" width="100%">
            <tr>
              <td width="33%"><label for="gebruikersnaamn">Gebruikersnaam:</label></td>
              <td width="67%"><input accesskey="g" id="gebruikersnaamn" name="gebruikersnaamn" style="width: 99%" type="text" value="<?php echo $gebruikersnaam; ?>"></td>
            </tr>
            <tr>
              <td><label for="wachtwoord">Wachtwoord:</label></td>
              <td><input accesskey="w" id="wachtwoord" name="wachtwoord" style="width: 99%" type="password"></td>
            </tr>
            <tr>
              <td><label for="wachtwoordbevestigd">Wachtwoord bevestigen:</label></td>
              <td><input accesskey="b" id="wachtwoordbevestigd" name="wachtwoordbevestigd" style="width: 99%" type="password"></td>
            </tr>
          </table>
          <legend><h3>Gebruikersgegevens</h3></legend>
          <table border="0" cellpadding="0" cellspacing="3" width="100%">
            <tr>
              <td width="25%"><label for="m">Geslacht:</label></td>
              <td width="75%">
                <label for="m">
                  <input accesskey="m" <?php if ($geslacht == 1) echo "checked"; ?> id="m" name="geslacht" type="radio" value="1"> Man
                </label>&nbsp;&nbsp;&nbsp;
                <label for="v">
                  <input accesskey="v" <?php if ($geslacht == 0) echo "checked"; ?> id="v" name="geslacht" type="radio" value="0"> Vrouw
                </label>
              </td>
            </tr>
            <tr>
              <td><label for="voornaam">Voornaam:</label></td>
              <td><input accesskey="n" id="voornaam" name="voornaam" style="width: 99%" type="text" value="<?php echo $voornaam; ?>"></td>
            </tr>
            <tr>
              <td><label for="achternaam">Achternaam:</label></td>
              <td><input accesskey="n" id="achternaam" name="achternaam" style="width: 99%" type="text" value="<?php echo $achternaam; ?>"></td>
            </tr>
            <tr>
              <td><label for="woonplaats">Woonplaats:</label></td>
              <td><input accesskey="p" id="woonplaats" name="woonplaats" style="width: 99%" type="text" value="<?php echo $woonplaats; ?>"></td>
            </tr>
            <tr>
              <td><label for="pr">Provincie:</label></td>
              <td><SELECT NAME="provincie" style="width: 99%">
                <OPTION VALUE="">(Selecteer een provincie)</OPTION>
                <?php
                    echo $optionprovincie;
                ?>
                </SELECT> 
            </tr>
            <tr>
              <td><label for="lc">Land:</label></td>
              <td><SELECT NAME="land" style="width: 99%">
                <OPTION VALUE="">(Selecteer een land)</OPTION>
                <?php
                    echo $optionland;
                ?>
                </SELECT>
            </tr>
            <tr>
              <td nowrap><label for="emailadres">E-mailadres:</label></td>
              <td><input accesskey="e" id="emailadres" name="emailadres" style="width: 99%" type="text" value="<?php echo $emailadres; ?>"></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td align="right"><br>
        <input name="ip" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
        <input name="submit" type="Submit" value="Bevestigen">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
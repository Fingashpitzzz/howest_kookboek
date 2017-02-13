<html>
    <head>
        <title>Gerecht toevoegen </title>
    </head>

    <body>
        <?php include("../aangemeld/inc_logged_in.php") ?>
        <?php
//soorten, categorien en tijden uit de database halen
            // Constanten voor mysql_connect() insluiten:
            require_once('../databaseconnecties/mysql_connect.inc.php');
            // Databaseverbinding openen en database selecteren:
            $verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysql_error());
            mysql_select_db("kookboek") or die(mysql_error());
            //soorten
            $sql1="SELECT id, naam FROM soort ";
            $resultaatsoort=mysql_query($sql1);
            
            $optionsoort="";
            
            while ($row=mysql_fetch_array($resultaatsoort)) {
            
                $id=$row["id"];
                $soort=$row["naam"];
                $optionsoort.="<OPTION VALUE=\"$soort\">".$soort.'</option>';
            }
            
            //categorieen
            $sql1="SELECT id, naam FROM categorie ";
            $resultaatcategorie=mysql_query($sql1);
            
            $optioncategorie="";
            
            while ($row=mysql_fetch_array($resultaatcategorie)) {
            
                $id=$row["id"];
                $categorie=$row["naam"];
                $optioncategorie.="<OPTION VALUE=\"$categorie\">".$categorie.'</option>';
            }                                
                                
            //bereidingstijden
            $sql1="SELECT id, tijd FROM bereidingstijden ";
            $resultaattijd=mysql_query($sql1);
            
            $optiontijd="";
            
            while ($row=mysql_fetch_array($resultaattijd)) {
            
                $id=$row["id"];
                $tijd=$row["tijd"];
                $optiontijd.="<OPTION VALUE=\"$tijd\">".$tijd.'</option>';
            }
                
// Formulier lezen en controleren:
if (isset($_POST['submit'])) {
    $gerechtnaam = ($_POST['gerechtnaam']);
    
    $melding = ""; // String voor (fout)meldingen

    if (strlen($gerechtnaam) < 2) {
        $melding .= "De naam moet minimaal 2 tekens lang zijn. ";
    }
    

    // Overige receptgegevens lezen:
    $bereiding          = $_POST['bereiding'];
    $optiontijd         = $_POST['tijd'];
    $optioncategorie    = $_POST['categorie'];
    $nieuwcategorie     = $_POST['nieuwcategorie'];
    $optionsoort        = $_POST['soort'];
    $ingredienten       = $_POST['ingredienten'];

    // Databaseverbinding pas openen als er geen foutmeldingen zijn:
    if ($melding == "") {
        //controleren of er een oude categorie werd gekozen of een nieuwe werd ingevoert
        if (empty($optioncategorie)) {
            // Eerst controleren of de naam van het recept al bestaat ...
                $sql1  = "SELECT `naam` FROM `gerechten` ";
                $sql1 .= "WHERE `naam` = 'gerechtnaam'";
            // ... en daarna eventueel een nieuw gerecht toevoegen:
                $sql2  = "INSERT INTO `gerechten` (`naam`, `bereiding`, `bereidingstijd`, `categorie`, `soort`, `ingredient`, `gebruikersnaam`)";
                $sql2 .= "VALUES (";
                $sql2 .= "'$gerechtnaam', '$bereiding', '$optiontijd', '$nieuwcategorie', '$optionsoort', '$ingredienten', '$gebruikersnaam'";
                $sql2 .= "); ";
            // Nieuwe categorie in tabel categorieen steken
                $sql3  = "INSERT INTO `categorie` (`naam`)";
                $sql3 .= "VALUES (";
                $sql3 .= "'$nieuwcategorie'";
                $sql3 .= "); ";
                
                
                
            // Constanten voor mysql_connect() insluiten:
            require_once('../databaseconnecties/mysql_connect.inc.php');
            // Databaseverbinding openen en database selecteren:
            $verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysql_error());
            mysql_select_db("kookboek") or die(mysql_error());
            // De eerste query uitvoeren:
            $resultaat = mysql_query($sql1) or die(mysql_error());
            // De tweede query uitvoeren als de receptnaam niet is gevonden:
            if (mysql_num_rows($resultaat) == 0) {
                mysql_free_result($resultaat);
                mysql_query($sql2) or die(mysql_error());
                mysql_query($sql3) or die(mysql_error());
                mysql_close($verbinding);
                // Succesvolle registratie melden:
                if (!headers_sent()) {
                    header("Cache-Control: no-store, no-cache, must-revalidate");
                    header("Cache-Control: post-check=0, pre-check=0", false);
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                }
                echo "<h2>Recept toegevoegd</h2>\n";
                echo "<p>Er is een recept toegevoegd, namelijk <strong>$gerechtnaam</strong>.</p>";
                exit;
            } else {
                mysql_free_result($resultaat);
                mysql_close($verbinding);
                $melding .= "Er is al een recept met de naam <strong>$gerechtnaam</strong> toegevoegd. ";
                $gerechtnaam = "";
            }
        }
        else {
            // Eerst controleren of de naam van het recept al bestaat ...
            $sql1  = "SELECT `naam` FROM `gerechten` ";
            $sql1 .= "WHERE `naam` = 'gerechtnaam'";
            // ... en daarna eventueel een nieuw gerecht toevoegen:
                $sql2  = "INSERT INTO `gerechten` (`naam`, `bereiding`, `bereidingstijd`, `categorie`, `soort`, `ingredient`, `gebruikersnaam`)";
                $sql2 .= "VALUES (";
                $sql2 .= "'$gerechtnaam', '$bereiding', '$optiontijd', '$optioncategorie', '$optionsoort', '$ingredienten', '$gebruikersnaam'";
            $sql2 .= "); ";
        

            // Constanten voor mysql_connect() insluiten:
            require_once('../databaseconnecties/mysql_connect.inc.php');
            // Databaseverbinding openen en database selecteren:
            $verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysql_error());
            mysql_select_db("kookboek") or die(mysql_error());
            // De eerste query uitvoeren:
            $resultaat = mysql_query($sql1) or die(mysql_error());
            // De tweede query uitvoeren als de receptnaam niet is gevonden:
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
                echo "<h2>Recept toegevoegd</h2>\n";
                echo "<p>Er is een recept toegevoegd, namelijk <strong>$gerechtnaam</strong>.</p>";
                exit;
            } else {
                mysql_free_result($resultaat);
                mysql_close($verbinding);
                $melding .= "Er is al een recept met de naam <strong>$gerechtnaam</strong> toegevoegd. ";
                $gerechtnaam = "";
            }
        }
    }


} else {
    // Standaardtekst voor de instructies:
    $melding  = "Met het onderstaande formulier kunt u een nieuw gerecht invoeren. ";

    // Lege formuliervelden:
    $gerechtnaam        = "";
    $ingredienten       = "";
    $bereiding          = "";
    $ingredienten       = "";
    $nieuwcategorie     = "";
}

// HTTP-headers toevoegen:
if (!headers_sent()) {
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
}

?>
    </body>
    <link type="text/css" rel="stylesheet" href="opmaak.css" />
    <h2>Gerecht toevoegen</h2>
    <p><?php echo $melding; ?></p>
    <form action="recept invoegen.php" method="post">
        <table border="0" cellpadding="0" cellspacing="0" width="400">
            <tr>
                <td>
                    <fieldset>
                        <table border="0" cellpadding="0" cellspacing="3" width="100%">
                            <tr>
                                <td width="33%"><label for="gerechtnaam">Gerechtnaam:</label></td>
                                <td width="67%"><input accesskey="g" id="gerechtnaam" name="gerechtnaam" style="width: 99%" type="text" value="<?php echo $gerechtnaam; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="soort">Soort gerecht:</label></td>
                                <td><SELECT NAME=soort>
                                    <OPTION VALUE="">(Selecteer een soort gerecht)</OPTION>
                                    <?php
                                        echo $optionsoort;
                                    ?>
                                    </SELECT> 
                            </tr>
                            <tr>
                                <td><label for="categorie">Categorie:</label></td>
                                <td><SELECT NAME=categorie>
                                    <OPTION VALUE="">(Selecteer een categorie)</OPTION>
                                    <?php
                                        echo $optioncategorie;
                                    ?>
                                    </SELECT>
                                    of
                            </tr>
                            <tr>
                                <td width="33%"><label for="nieuwcategorie">Nieuwe categorie:</label></td>
                                <td width="67%"><input accesskey="g" id="nieuwcategorie" name="nieuwcategorie" style="width: 99%" type="text" value="<?php echo $nieuwcategorie; ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="tijd">Bereidingstijd:</label></td>
                                <td><SELECT NAME=tijd>
                                    <OPTION VALUE="">(Selecteer een tijdsduur)</OPTION>
                                    <?php
                                        echo $optiontijd;
                                    ?>
                                    </SELECT>
                            </tr>
                            <tr>
                                <td width="33%"><label for="ingredienten">Ingredienten:</label></td>
                                <td width="67%">
                                    <textarea accesskey="i" id="ingredienten" name="ingredienten" style="width: 99%" rows = "5" type="text" value="<?php echo $ingredienten; ?>"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="33%"><label for="bereiding">Bereiding:</label></td>
                                <td width="67%">
                                    <textarea accesskey="b" id="bereiding" name="bereiding" style="width: 99%" rows = "5" type="text" value="<?php echo $bereiding; ?>"></textarea>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td align="right"><br>
                    <input name="ip" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                    <input name="submit" type="Submit" value="Bevestigen"> &nbsp;
                </td>
            </tr>
        </table>
    </form>
</html>
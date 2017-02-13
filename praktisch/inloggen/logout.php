<?php 
    session_start();
    session_unset(); // alle variabelen vrijgeven
    session_destroy(); // sessie afsluiten
?>

<html>
    <head>
        <title>Uitloggen</title>
    </head>

	<link type="text/css" rel="stylesheet" href="../opmaak.css" />
        <h2>Uitloggen</h2>
        <hr>
        U bent nu uitgelogd. <br>
        <a href="../../links.html" target="links" onClick="parent.rechts.location.href='../../home.html';">verder</a>
    </body>
</html>
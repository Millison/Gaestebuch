<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Anmelden</title>
</head>

<body>
<h2>Anmelden</h2>
<br />
<?php
	# Bei Reload bleiben die Eingaben in Eingabefelder stehen 
	if (isset($_POST["logname"])) {
		$logname = htmlspecialchars($_POST["logname"]);
		$passwort = htmlspecialchars($_POST["passwort"]);
	}
	else {
		$logname = "";
		$passwort = "";
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	Logginname: <br />
	<input type="text" name="logname" size="20" maxlength="30" value="<?php echo $logname; ?>" />
	<br />
	Passwort: <br />
	<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo $passwort; ?>" />
	<br />
	<input type="submit" value="Anmelden" href="#"/>
	<br />
</form>
<?php
	# Aktion mit der Daten aus dem Formular
	if (isset($_POST["logname"])) {
		#echo "Die Eingaben: <br />";
		#echo "Logname: $logname, Passwort: $passwort <br />";
		$anmeldeperson = array ("logname" => $logname, "passwort" => $passwort);
		include "anmelden_script.php";
		$eintrit = new Anmeldung($anmeldeperson);
		$eintrit->benutzerTest($anmeldeperson); 
	}
?>

<p>
<a href="startseite.php">Zurück zur Startseite</a>
</p>

</body>
</html>
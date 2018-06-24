<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Regestrierung</title>
</head>

<body>
<h2>Regestrierung</h2>
<br />
<?php
	# Bei Reload bleiben die Eingaben in Eingabefelder stehen 
	if (isset($_POST["vorname"])) {
		$vorname = htmlspecialchars($_POST["vorname"]);
		$nachname = htmlspecialchars($_POST["nachname"]);
		$logname = htmlspecialchars($_POST["logname"]);
		$passwort = htmlspecialchars($_POST["passwort"]);
		$pass_two = htmlspecialchars($_POST["pass_two"]);
		$rechte = htmlspecialchars($_POST["rechte"]);
	}
	else {
		$vorname = "";
		$nachname = "";
		$logname = "";
		$passwort = "";
		$pass_two = "";
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	Ihr Vorname: <br />
	<input type="text" name="vorname" size="20" maxlength="30" value="<?php echo $vorname; ?>" />
	<br />
	Ihr Nachname: <br />
	<input type="text" name="nachname" size="20" maxlength="30" value="<?php echo $nachname; ?>" />
	<br />
	Logginname: <br />
	<input type="text" name="logname" size="20" maxlength="30" value="<?php echo $logname; ?>" />
	<br />
	Passwort: <br />
	<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo $passwort; ?>" />
	<br />
	Passwort (wiederholen): <br />
	<input type="password" name="pass_two" size="20" maxlength="30" value="<?php echo $pass_two; ?>" />
	<br />
	Berechtigung: <br />
	<input type="radio" name="rechte" value="1"><label> Admin</label><br />
	<input type="radio" name="rechte" value="0"><label>  Benutzer</label><br />
	<input type="submit" value="Registrieren" />
	<br />
</form>
<?php
	# Aktion mit der Daten aus dem Formular
	if (isset($_POST["vorname"])) {
		if( strcmp($_POST["passwort"], $_POST["pass_two"]) == 0 ) {
			$benutzerDaten = array (
								"vorname" => $vorname,
								"nachname" => $nachname,
								"logname" => $logname,
								"passwort" => $passwort,
								"rechte" => $rechte);
			include "neuer_benutzer_script.php";
			$db_aktion = new Verbindung($benutzerDaten);
			$db_aktion->benutzerTest();
		} else {
			echo "Passwort ist nicht identisch!";
		}
	}
?>
<p>
<a href="startseite.php">Zurück zur Startseite</a>
</p>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Eintrag</title>
</head>

<body>
<h2>Komentar eintragen</h2>
<br />

<form action="einPHPdokument.php" method="post">
	Ihr Kommentar: <br />
	<textarea name="text" cols="50" rows="10"></textarea>
	<br />
	<input type="submit" value="Senden" />
	<br />
</form>

<?php
	include "ausgabe.php";
	# Aktion mit der Daten aus dem Formular
	if (isset($_POST["text"])) {
		$db_aktion = new Komentar($benutzerDaten);
		$db_aktion->benutzerTest();
		echo "Ihr Kommentar ist gespeichert.";
	}
?>

</body>
</html>
<?php
	
	$mysqli = new mysqli("localhost", "root", "", "gaestebuch");
	
	if ($mysqli->connect_error) {
		echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
		exit();
	}
	
	if (!$mysqli->set_charset("utf8")) {
		echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
	}
	
	$eintraege = $mysqli->query("SELECT logname, zeit, text FROM buch;");
	echo "<p> Anzahl der Einträge: " . count($eintraege) . "</p>";
	
	while ($zeile = $eintraege->fetch_array()) {
		echo "<strong>{$zeile['logname']} {$zeile['zeit']}</strong>: {$zeile['text']} ";
	}
	
	$eintraege->close();
	$mysqli->close();
?>
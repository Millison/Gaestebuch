<?php
	
class Anmeldung {
	
	public $benutzerDaten;
	public $mysqli;
	public $test;
	
	// Später nicht hier, sondern bei jedem Klasse-Aufruf eingebn
	public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "gaestebuch";
	
	public function __construct($neueBenutzer) {
		$mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	
		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}
		
		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		}
		
		#echo "Verbindung hat geklappt!";
		$this->mysqli = $mysqli;
		$this->benutzerDaten = $neueBenutzer;
	}
	
	public function benutzerTest($anmeldeperson) {
		$eintraege = $this->mysqli->query("SELECT logname, passwort FROM benutzer;");
		$benutzerGefunden = 0;
		
		while ($zeile = $eintraege->fetch_array()) {
			if (strcmp($anmeldeperson["logname"], $zeile["logname"]) == 0) {
				$benutzerGefunden = 1;
				if (strcmp($anmeldeperson["passwort"], $zeile["passwort"]) == 0) {
					echo "Sie sind angemeldet!";
				} else {
					echo "Passwort ist Falsch!";
					exit();
				}
			}
		}
		if ($benutzerGefunden == 0) {
			echo "Benutzer ... ist unbekant!";
		}
		
		$eintraege->close();
		$this->mysqli->close();
		exit();
	}
}
	
?>
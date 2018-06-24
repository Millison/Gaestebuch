<?php

class Verbindung {
	
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
		
		echo "Verbindung hat geklappt!";
		$this->mysqli = $mysqli;
		$this->benutzerDaten = $neueBenutzer;
	}
	
	public function benutzerTest() {
		$eintraege = $this->mysqli->query("SELECT logname FROM benutzer;");
		echo "Test1!";
		while ($zeile = $eintraege->fetch_array()) {
			if (strcmp($this->benutzerDaten["logname"], $zeile["logname"]) == 0) {
				echo "Benutzer mit dem Name <strong>{$zeile['logname']}</strong> existiert schon!";
				$eintraege->close();
				$this->mysqli->close();
				exit();
			} else {
				$this->registrierung();
			}
		}
	}
	
	public function registrierung() {
		$insert = $this->mysqli->prepare("INSERT INTO benutzer
											(vorname,
											nachname,
											logname,
											passwort,
											rechte)
											VALUES(?, ?, ?, ?, ?)");
		$insert->bind_param("sssss", $this->benutzerDaten["vorname"],
									$this->benutzerDaten["nachname"],
									$this->benutzerDaten["logname"],
									$this->benutzerDaten["passwort"],
									$this->benutzerDaten["rechte"]); 
		if($ergebnis = $insert->execute()) {
			echo "Sie sind registriert.";
			#$ergebnis->close();
			$this->mysqli->close();
		} else {
			echo "Fehler bei der Registrierung: <br />";
			echo $this->mysqli->error();
		}
	}
}
	
?>

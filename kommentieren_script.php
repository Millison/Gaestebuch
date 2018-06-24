<?php
	
class Komentar {
	
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
	
	public function neuerKommentar() {
		$insert = $this->mysqli->prepare("INSERT INTO buch
											(logname,
											text,
											zeit,
											status,
											parents)
											VALUES(?, ?, ?, ?, ?)");
		$insert->bind_param("sssss", $this->benutzerDaten["logname"],
									$this->benutzerDaten["text"],
									$this->benutzerDaten["zeit"],
									$this->benutzerDaten["status"],
									$this->benutzerDaten["parents"]); 
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
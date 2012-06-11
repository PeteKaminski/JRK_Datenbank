<?php
define('DEBUG', 'DEBUG');
class User_model extends CI_Model {
	/*
	 *  Das User-Model geht davon aus, dass alle Eingabe geprüft auf XXS und Sqlinjektion geprüft wurden
	 *
	 */

	public function __construct() {
		$this -> load -> database();
	}

	public function get_user($userID = FALSE) {
		if ($userID == FALSE) {
			return FALSE;
		}

		/* Bsp. fuer SQL WHERE query
		 * SELECT * FROM Persons WHERE UserID=1;
		 */

		$query = "SELECT * FROM `User` WHERE UserID = $userID;";

		$DBAnswer = $this -> db -> query($query);

		$DBAnswer = $DBAnswer -> result();

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input: \$userID = $userID;";
			echo "SQL Query [" + __FUNCTION__ + "]: " . $query;
			echo "SQL Antwort  [" + __FUNCTION__ + "]: " . $DBAnswer;
			echo '</div>';
		}

		if ($DBAnswer != 0) {
			return $DBAnswer[0];
		} else {
			return FALSE;
		}
	}

	public function isUserAvailable($data) {

		if (empty($data['Vorname'])) {
			$data['Vorname'] = false;
		}

		if ((!isset($data['Name'])) || empty($data['Name'])) {
			$data['Name'] = false;
		}

		if ((!isset($data['Geburtstag'])) || empty($data['Geburtstag'])) {
			$data['Geburtstag'] = false;
		}

		if ((!isset($data['Plz'])) || empty($data['Plz'])) {
			$data['Plz'] = false;
		}

		if ($data['Vorname'] == false || $data['Vorname'] == false) {
			return false;
			// es braucht nicht gesucht werden, da kein Vorname vorhanden ist
		}

		/*
		 * SELECT UserID, Vorname, Name...* FROM User WHERE Vorname LIKE 'Re%' AND Name LIKE 'Ga%'
		 */

		$query = 'SELECT UserID, Vorname';
		$query_ende = "Vorname LIKE '" . $data['Vorname'] . "%' ";

		if ($data['Name']) {
			$query = $query . ',Name';
			$query_ende = $query_ende . "AND Name Like '" . $data['Name'] . "%' ";
		}
		if ($data['Geburtstag']) {
			$query = $query . ',Geburstag';
			// nachschauen ob es wirklich so heißt
			$query_ende = $query_ende . "AND Geburstatg LIKE'" . $data['Geburtstag'] . "%' ";
			// evtl. vorher umformen zum type tiemstamp
		}
		if ($data['Plz']) {
			$query = $query . ',Plz';
			$query_ende = $query_ende . " AND Plz='" . $data['Plz'] . "%'";
		}

		$query = $query . ' FROM User WHERE ';

		// Jetzt kommt die eignetliche abfrage
		$DBAnswer = $this -> db -> query($query . $query_ende);
		$DBAnswer = $DBAnswer -> result();

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "<p>[isUserAvailable] input: \$vorname = " . $data['Vorname'] . "; \$name = " . $data['Name'] . "; \$geburtastag = " . $data['Geburtstag'] . "; \$plz = " . $data['Plz'] . '</p>';
			echo "<p>SQL Query [isUserAvailable]: " . $query . $query_ende . '</p>';
			echo "<p>SQL Antwort  [isUserAvailable]: " . $DBAnswer . '</p>';
			echo '</div>';
		}

		if ($DBAnswer != 0) {
			return $DBAnswer;
		} else {
			return FALSE;
		}
	}

	private function prepareArray($data) {
		if (empty($data['Vorname'])) {
			$data['Vorname'] = false;
		}

		if ((!isset($data['Name'])) || empty($data['Name'])) {
			$data['Name'] = false;
		}

		if ((!isset($data['Foermlich'])) || empty($data['Foermlich'])) {
			$data['Foermlich'] = false;
		}

		if ((!isset($data['Strasse'])) || empty($data['Strasse'])) {
			$data['Strasse'] = false;
		}

		if ((!isset($data['Hausnr'])) || empty($data['Hausnr'])) {
			$data['Hausnr'] = false;
		}

		if ((!isset($data['Plz'])) || empty($data['Plz'])) {
			$data['Plz'] = false;
		}

		if ((!isset($data['Ort'])) || empty($data['Ort'])) {
			$data['Ort'] = false;
		}

		if ((!isset($data['Bezirk'])) || empty($data['Bezirk'])) {
			$data['Bezirk'] = false;
		}

		if ((!isset($data['Geburtstag'])) || empty($data['Geburtstag'])) {
			$data['Geburtstag'] = false;
		}

		if ((!isset($data['Beruf'])) || empty($data['Beruf'])) {
			$data['Beruf'] = false;
		}

		if ((!isset($data['Arbeitszeit'])) || empty($data['Arbeitszeit'])) {
			$data['Arbeitszeit'] = false;
		}

		if ((!isset($data['JrkMitglied'])) || empty($data['JrkMitglied'])) {
			$data['JrkMitglied'] = false;
		}

		if ((!isset($data['Faehigkeiten'])) || empty($data['Faehigkeiten'])) {
			$data['Faehigkeiten'] = false;
		}

		if ((!isset($data['BevorzugteKommunikation'])) || empty($data['BevorzugteKommunikation'])) {
			$data['BevorzugteKommunikation'] = false;
		}

		if ((!isset($data['Anmerkung'])) || empty($data['Anmerkung'])) {
			$data['Anmerkung'] = false;
		}

		if ((!isset($data['Facebook'])) || empty($data['Facebook'])) {
			$data['Facebook'] = false;
		}

		if ((!isset($data['Geschlecht'])) || empty($data['Geschlecht'])) {
			$data['Geschlecht'] = false;
		}

		if ((!isset($data['MitgleidSeit'])) || empty($data['MitgleidSeit'])) {
			$data['MitgleidSeit'] = false;
		}

		if ((!isset($data['Besonderheiten'])) || empty($data['Besonderheiten'])) {
			$data['Besonderheiten'] = false;
		}

		if ((!isset($data['Fuehrerschein'])) || empty($data['Fuehrerschein'])) {
			$data['Fuehrerschein'] = false;
		}

		if ((!isset($data['ErweitertesFuehrungszeugnis'])) || empty($data['ErweitertesFuehrungszeugnis'])) {
			$data['ErweitertesFuehrungszeugnis'] = false;
		}

		if ((!isset($data['ZeugnisVorlgeletam'])) || empty($data['ZeugnisVorlgeletam'])) {
			$data['ZeugnisVorlgeletam'] = false;
		}

		return $data;
	}

	public function addUser($data) {
		/*
		 * returned die insert ID
		 */
		$data = $this -> prepareArray($data);

		/*
		 * SQL Insert Bsp.: INSERT INTO table_name (column1, column2, column3,...)
		 * VALUES (value1, value2, value3,...)
		 */
		$query_front = 'INSERT INTO User (';
		$query_back = 'VALUES (';

		// fuer den ersten DB-Wert, damit er kein Komma schreibt
		$isNotFirstEntry = FALSE;

		if ($data['Vorname'] == false || $data['Name'] == false) {
			return false;
		}

		foreach ($data as $key => $value) {
			if ($value) {/*
				 * Sonderfaell berachten fuer BOOL und INT
				 * DATE ggf. wandeln
				 */

				switch ($key) {
					case 'Foermlich' || 'JrkMitglied' || 'Fuehrerschein' || 'ErweitertesFuehrungszeugnis' || 'Plz' :
						// hier brauch nix passieren
						break;
					default :
						//$value = "'".$value."'";
						break;
				}

				if ($isNotFirstEntry) {
					$query_front = $query_front . ',' . $key;
					$query_back = $query_back . ",'" . $value . "'";
				} else {
					$query_front = $query_front . $key;
					$query_back = $query_back . "'" . $value . "'";
					$isNotFirstEntry = TRUE;
				}
			}
		}

		$query_front = $query_front . ') ';
		$query_back = $query_back . ')';
		$DBAnswer = $this -> db -> query($query_front . $query_back);

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "[addUser] input:";
			echo '<pre>';
			print_r($data);
			echo '</pre>';
			echo "SQL Query [addUser]: " . $query_front . $query_back;
			echo "SQL Antwort  [addUser]: " . $this -> db -> insert_id();
			echo '</div>';
		}

		if ($DBAnswer != 0) {
			return $this -> db -> insert_id();
		} else {
			return FALSE;
		}
	}

	public function deleteUser($userID = FALSE) {
		if ($userID == FALSE) {
			return FALSE;
		}

		/* Bsp. fuer SQL DELETE query
		 * DELETE FROM table_name WHERE UserID=3;
		 */

		$this -> deleteDependentData($userID);

		$query = "DELETE * FROM User WHERE UserID = $userID";

		//$DBAnswer = $this->db->query($query);

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "[deleteUser] input: \$userID = $userID;";
			echo "<p>SQL Query [deleteUser]: " . $query . '</p>';
			//echo "<p>SQL Antwort  [deleteUser]: ".$DBAnswer.'</p>';
			echo '</div>';
		}

		if (isset($DBAnswer)) {
			return $DBAnswer;
		} else {
			return FALSE;
		}
	}

	public function updateUser($userID = false, $data) {/*
		 * $vorname=false,$nachname=false,$strasse=false,$hausnummer=false,$plz=false,
		 * $geburtstag=false,$beruf=false,$arbeitszeiten=false,$jrkmitglied=false,
		 * $faehigkeiten=false,$bevorzugteKom=false,$anmerkung=false,$facebook=false,
		 * $geschlecht=false,$mitgliedSeit=false,$besonderheiten=false,
		 * $fuehrerschein=false,$erweiteresZeugnis=false,$vorgelegt=false,
		 * $foermlich=false
		 */

		if ($userID == FALSE) {
			return FALSE;
		}

		$data = $this -> prepareArray($data);

		/*
		 * SQL UPDATE Bsp.: UPDATE Persons SET Address='Nissestien 67', City='Sandnes'
		 * WHERE LastName='Tjessem' AND FirstName='Jakob'
		 */
		$query_front = 'UPDATE User SET ';
		$query_back = " WHERE UserID=$userID";

		// fuer den ersten DB-Wert, damit er kein Komma schreibt
		$isNotFirstEntry = FALSE;

		foreach ($data as $key => $value) {
			if ($value) {
				$tmp = FALSE;

				/*
				 * Sonderfaell berachten fuer BOOL und INT
				 * DATE ggf. wandeln
				 */

				switch ($key) {
					case 'Foermlich' :
						$tmp = "$key=$value";
						break;
					case 'JrkMitglied' :
						$tmp = "$key=$value";
						break;
					case 'Fuehrerschein' :
						$tmp = "$key=$value";
						break;
					case 'ErweitertesFuehrungszeugnis' :
						$tmp = "$key=$value";
						break;
					case 'Plz' :
						$tmp = "$key=$value";
						break;
					default :
						$tmp = "$key='$value'";
						break;
				}

				if ($isNotFirstEntry) {
					$query_front = $query_front . ',' . $tmp;
				} else {
					$query_front = $query_front . $tmp;
					$isNotFirstEntry = TRUE;
				}
			}
		}

		$DBAnswer = $this -> db -> query($query_front . $query_back);

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "<p>[updateUser] input:" . '</p>';
			echo '<pre>';
			print_r($data);
			echo '</pre>';
			echo "<p>SQL Query [updateUser]: " . $query_front . $query_back . '</p>';
			echo "<p>SQL Antwort  [updateUser]: " . $this -> db -> affected_rows() . '</p>';
			echo '</div>';
		}

		if ($DBAnswer != 0) {
			return $this -> db -> affected_rows();
		} else {
			return FALSE;
		}
	}

	public function getOldUser() {
		/*
		 * Bsp. fuer auffinden von Eintraegen, die aelter als 1 jahr sind
		 * SELECT UserID FROM User AS U WHERE U.LetzteAenderung < date_add(current_date, interval -1 year)
		 */

		$query = 'SELECT UserID, LetzteAenderung FROM User AS U WHERE U.LetzteAenderung < date_add(current_date, interval -1 year)';

		$DBAnswer = $this -> db -> query($query);
		$DBAnswer = $DBAnswer -> result();

		$query['anzahl'] = count($query);

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "<p>SQL Query [getOldUser]: " . $query . '</p>';
			echo "<p>SQL Antwort  [getOldUser]: " . $DBAnswer . '</p>';
			echo '</div>';
		}

		if ($DBAnswer != 0) {
			return $DBAnswer;
		} else {
			return FALSE;
		}
	}

	private function deleteDependentData($userID = false) {
		/*
		 * Zum loeschen eines User müssen die Abhaenigkeiten gefunden werden und geloescht werden!
		 */

		If (defined('DEBUG')) {
			echo '<div id="debug">';

			$tables = array('Telefon', 'Email', 'UserKreisverband', 'UserVeranstaltung', 'UserQualifikation', 'UserInteressen', 'UserPosition');
			foreach ($tables as $value) {
				$DBAnswer = 0;
				$query = "SELECT COUNT(UserID) FROM $value WHERE UserID=$userID;";
				$DBAnswer = $this -> db -> query($query);
				//echo "<p>SQL Query [deleteDependentData]: ".$query.'</p>';
				if (isset($DBAnswer)) {
					//$DBAnswer = $DBAnswer->result();
					$row = $DBAnswer -> row_array();
					echo "<p><b>SQL Antwort  [deleteDependentData]: gefunde Abh&auml;nigkeitenvon $value: " . $row['COUNT(UserID)'] . '</b></p>';
				} else {
					echo "<p><b>SQL Antwort  [deleteDependentData]: gefunde Abh&auml;nigkeiten von $value: 0</b></p>";
				}

			}
			echo '</div>';
		}

		/*
		 * nun alle verweise auf gelöschten user umlenkten (nur in Veranstaltungen)
		 */

		$query = "SELECT AnmeldeID FROM `userveranstaltung` WHERE UserID=$userID;";
		$DBAnswer = $this -> db -> query($query);
		$DBAnswer = $DBAnswer -> result_array();

		//Bsp.: UPDATE userveranstaltung SET UserID=1 WHERE AnmeldeID=2 OR AnmeldeID=1
		$query = 'UPDATE userveranstaltung SET UserID=1 WHERE ';
		$isFirst = TRUE;
		$affected_rows = 0;
		foreach ($DBAnswer as $key => $value) {
			$affected_rows++;
			if (!$isFirst) {
				$query = $query . ' OR ';
			} else {
				$isFirst = FALSE;
			}
			$query = $query . 'AnmeldeID=' . $DBAnswer[$key]['AnmeldeID'];
		}

		if ($affected_rows > 0) {
			$DBAnswer = $this -> db -> query($query);
			if ($this -> db -> affected_rows() < $affected_rows) {
				return "Error: Can't Update userveranstaltung for User=$userID";
			}
		}

		/*
		 * Nun muss der User aus allen restlichen Tabellen (Telefon:, Email, UserKreisverband, UserQualifikation, UserInteressen, UserPosition)
		 * gelöscht werden!
		 */
		 /*
		$tables = array('Telefon', 'Email', 'UserKreisverband', 'UserQualifikation', 'UserInteressen', 'UserPosition');
		foreach ($tables as $value) {
			unset($DBAnswer);
			$query = "SELECT COUNT(UserID) FROM $value WHERE UserID=$userID;";
			$DBAnswer = $this -> db -> query($query);
			//echo "<p>SQL Query [deleteDependentData]: ".$query.'</p>';
			if (isset($DBAnswer)) {
				//$DBAnswer = $DBAnswer->result();
				$row = $DBAnswer -> row_array();
				echo "<p><b>SQL Antwort  [deleteDependentData]: gefunde Abh&auml;nigkeitenvon $value: " . $row['COUNT(UserID)'] . '</b></p>';
			} else {
				echo "<p><b>SQL Antwort  [deleteDependentData]: gefunde Abh&auml;nigkeiten von $value: 0</b></p>";
			}

		}
		*/
		
		//$query = 'DELETE Telefon, Email, UserKreisverband, UserVeranstaltung, UserQualifikation, UserInteressen, UserPosition WHERE UserID='.$userID;
		//$DBAnswer = $this->db->query($query);

		return true;
	}

	public function deleteOldUser($data) {
		/*
		 * Bsp. fuer auffinden von Eintraegen, die aelter als 1 jahr sind
		 * DELETE FROM User AS U WHERE User.LetzteAenderung < date_add(current_date, interval -1 year)
		 */

		foreach ($$data as $key => $value) {
			$this -> deleteUser($value);
		}

		If (defined('DEBUG')) {
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input:";
			echo '<pre>';
			print_r($data);
			echo '</pre>';
			echo "SQL Query [" + __FUNCTION__ + "]: " . $query . $query_ende;
			echo "SQL Antwort  [" + __FUNCTION__ + "]: " . $DBAnswer;
			echo '</div>';
		}

		return true;
	}

	public function updateLastAccess($userID = FALSE) {
		if (!$userID) {
			return FALSE;
		}

		$query = "UPDATE User SET LetzteAenderung=NOW() WHERE UserID=$userID";

		$DBAnswer = $this -> db -> query($query);

		return $this -> db -> affected_rows();
	}

}

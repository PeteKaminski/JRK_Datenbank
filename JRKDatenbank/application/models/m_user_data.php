<?php
class User_model extends CI_Model {
	/* git ist scheiße
	 *  Das User-Model geht davon aus, dass alle Eingabe geprüft auf XXS und Sqlinjektion geprüft wurden
	 * 
	 */

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user($userID = FALSE)
	{
		if ($userID == FALSE)
		{
			return FALSE;
		}
		
		/* Bsp. fuer SQL WHERE query
		 * SELECT * FROM Persons WHERE UserID=1; 
		*/
		
		$query    = "SELECT * FROM User WHERE UserID = $userID";
		
		$DBAnswer = $this->db->query($query);
		
		If(defined('DEBUG'))
		{
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input: \$userID = $userID;";
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		}
		
		if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function isUserAvailable($vorname=false,$nachname=false,$geburtastag=false,$plz=false)
	{
		if ( $vorname == false )
		{
			return false;
			// es braucht nicht gesucht werden, da kein Vorname vorhanden ist
		}
		$query = 'SELECT Vorname';
		$query_ende = "Vorname=\'$vorname\'";
		if($nachname)
		{
			$query = $query.',Nachname';
			$query_ende = $query_ende."Nachname=\'$nachname\'"; 
		}
		if($geburtastag)
		{
			$query = $query.',Geburstag';	// nachschauen ob es wirklich so heißt
			$query_ende = $query_ende."Geburstatg=\'$geburtastag\'"; // evtl. vorher umformen zum type tiemstamp
		}
		if($plz)
		{
			$query = $query.',Plz';
			$query_ende = $query_ende."Plz=\'$plz\'"; 
		}
		
		// Jetzt kommt die eignetliche abfrage
		$DBanswer = $this->db->query($query.$query_ende);
		
		If(defined('DEBUG'))
		{
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input: \$vorname = $vorname; \$nachname = $nachname; \$geburtastag = $geburtastag; \$plz = $plz";
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query.$query_ende;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		}
		
		if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}

	public function addUser($data)
	{	 /*
		 * $vorname=false,$nachname=false,$strasse=false,$hausnummer=false,$plz=false,
		 * $geburtstag=false,$beruf=false,$arbeitszeiten=false,$jrkmitglied=false,
		 * $faehigkeiten=false,$bevorzugteKom=false,$anmerkung=false,$facebook=false,
		 * $geschlecht=false,$mitgliedSeit=false,$besonderheiten=false,
		 * $fuehrerschein=false,$erweiteresZeugnis=false,$vorgelegt=false,
		 * $foermlich=false
		 */
		 
		 /*
		  * SQL Insert Bsp.: INSERT INTO table_name (column1, column2, column3,...)
		  * VALUES (value1, value2, value3,...)
		  */
		  $query_front = 'INSERT INTO User (';
		  $query_back  = 'VALUES (';
		  
		  // fuer den ersten DB-Wert, damit er kein Komma schreibt
		  $isNotFirstEntry = fasle; 
		 
		 foreach ($data as $key => $value) {
			 if( empty($key) )
			 {
			 	$data[$key] = fasle;
			 }else
			 {
				/*
				 * Sonderfaell berachten fuer BOOL und INT
				 * DATE ggf. wandeln
				*/
				 
				switch ($key) {
						case 'Foermlich' || 'JrkMitglied' || 'Fuehrerschein' || 'ErweitertesFuehrungszeugnis' || 'Plz':
							// hier brauch nix passieren
							break;		
						default:
							$value = "\'$value\'";
							break;
					}
				
			 	if($isNotFirstEntry)
				{
					$query_front = $query_front.','.$key;
					$query_back  = $query_back.','.$value;	
				}else
				{
					$query_front = $query_front.$key;
					$query_back  = $query_back.$value;
				}			 		
			 }
		 }
		 
		 if( $data['vorname'] == false || $data['nachname'] == false)
		 {
		 	return false;
		 } 
		 
		 
		 $DBAnswer = $this->db->query($query_front.$query_back);
		 
		 If(defined('DEBUG'))
		 {
		 	echo '<div id="debug">';
		 	echo "[" + __FUNCTION__ + "] input:";
			echo '<pre>';
		 	print_r($data);
			echo '</pre>';
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query_front.$query_back;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		 }
		 
		 if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}

	public function deleteUser($userID = FALSE)
	{
		if ($userID == FALSE)
		{
			return FALSE;
		}
		
		/* Bsp. fuer SQL DELETE query
		 * DELETE FROM table_name WHERE UserID=3; 
		*/
		
		deleteDependentData($userID);
		
		$query    = "DELETE * FROM User WHERE UserID = $userID";
		
		$DBAnswer = $this->db->query($query);
		
		If(defined('DEBUG'))
		{
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input: \$userID = $userID;";
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		}
		
		if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}

	public function updateUser($userID = false, $data)
	{	 /*
		 * $vorname=false,$nachname=false,$strasse=false,$hausnummer=false,$plz=false,
		 * $geburtstag=false,$beruf=false,$arbeitszeiten=false,$jrkmitglied=false,
		 * $faehigkeiten=false,$bevorzugteKom=false,$anmerkung=false,$facebook=false,
		 * $geschlecht=false,$mitgliedSeit=false,$besonderheiten=false,
		 * $fuehrerschein=false,$erweiteresZeugnis=false,$vorgelegt=false,
		 * $foermlich=false
		 */
		 
		if ($userID == FALSE)
		{
			return FALSE;
		}
		 
		 /*
		  * SQL UPDATE Bsp.: UPDATE Persons SET Address='Nissestien 67', City='Sandnes'
		  * WHERE LastName='Tjessem' AND FirstName='Jakob'
		  */
		  $query_front = 'UPDATE User SET ';
		  $query_back  = "WHERE UserID=$userID";
		  
		  // fuer den ersten DB-Wert, damit er kein Komma schreibt
		  $isNotFirstEntry = fasle; 
		 
		 foreach ($data as $key => $value) {
			 if( empty($key) )
			 {
			 	$data[$key] = fasle;
			 }else
			 {
			 	$tmp = FALSE;
				
				/*
				 * Sonderfaell berachten fuer BOOL und INT
				 * DATE ggf. wandeln
				*/
				 
				switch ($key) {
						case 'Foermlich' || 'JrkMitglied' || 'Fuehrerschein' || 'ErweitertesFuehrungszeugnis' || 'Plz':
							$tmp = "$key=$value";
							break;		
						default:
							$tmp = "$key=\'$value\'";
							break;
					}
				
			 	if($isNotFirstEntry)
				{
					$query_front = $query_front.','.$tmp;
				}else
				{
					$query_front = $query_front.$tmp;
				}			 		
			 }
		 }		 
		 
		 $DBAnswer = $this->db->query($query_front.$query_back);
		 
		 If(defined('DEBUG'))
		 {
		 	echo '<div id="debug">';
		 	echo "[" + __FUNCTION__ + "] input:";
			echo '<pre>';
		 	print_r($data);
			echo '</pre>';
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query_front.$query_back;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		 }
		 
		 if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}

	public function getOldUser()
	{
		/*
		 * Bsp. fuer auffinden von Eintraegen, die aelter als 1 jahr sind
		 * SELECT UserID FROM User AS U WHERE U.LetzteAenderung < date_add(current_date, interval -1 year)
		 */
		
		$query = 'SELECT UserID, LetzteAenderung FROM User AS U WHERE U.LetzteAenderung < date_add(current_date, interval -1 year)';
		
		$query['anzahl'] = count($query);
		
		$DBanswer = $this->db->query($query.$query_ende);
		
		If(defined('DEBUG'))
		{
			echo '<div id="debug">';
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		}
		
		if ($DBAnswer!=0)
		{
			 return $DBAnswer;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	/*
	 * das hier sollten wir evtl. mit nem trigger erledigen.
	*/
	private function deleteDependentData($userID=false)
	{
		/*
		 * Zum loeschen eines User müssen die Abhaenigkeiten gefunden werden und geloescht werden!
		*/
		
		
		If(defined('DEBUG'))
		{
			$query    = "SELECT COUNT(UserID) FROM Telefon, Email, UserKreisverband, UserVeranstaltung, UserQualifikation, UserInteressen, UserPosition WHERE UserID=$userID;";
			$DBAnswer = $this->db->query($query);
			echo '<div id="debug">';
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: gefunde Abh&auml;nigkeiten: ".$DBAnswer;
			echo '</div>';
		}
		
		$query = '';
		
		$query = 'DELETE Telefon, Email, UserKreisverband, UserVeranstaltung, UserQualifikation, UserInteressen, UserPosition WHERE UserID='.$userID;
		$DBAnswer = $this->db->query($query);
		
		return true;			
	}

	public function deleteOldUser($data)
	{
		/* 
		 * Bsp. fuer auffinden von Eintraegen, die aelter als 1 jahr sind
		 * DELETE FROM User AS U WHERE User.LetzteAenderung < date_add(current_date, interval -1 year)
		 */
		
		foreach ($$data as $key => $value) {
			$this->deleteUser($value);
		}
		
		If(defined('DEBUG'))
		{
			echo '<div id="debug">';
			echo "[" + __FUNCTION__ + "] input:";
			echo '<pre>';
			print_r($data);
			echo '</pre>';
			echo "SQL Query [" +  __FUNCTION__ + "]: ".$query.$query_ende;
			echo "SQL Antwort  ["+ __FUNCTION__ +"]: ".$DBAnswer;
			echo '</div>';
		}
		
		return true;
	}
}
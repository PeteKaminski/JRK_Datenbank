<?php
class User_model extends CI_Model {
	/*
	 *  Das User-Model geht davon aus, dass alle Eingabe geprüft auf XXS und Sqlinjektion geprüft wurden
	 * 
	 */

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user($vorname = FALSE)
	{
		if ($vorname === FALSE)
		{
			$query = $this->db->get('User');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('User', array('vorname' => $vorname));
		return $query->row_array();
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
			$query = $query + ',Nachname';
			$query_ende = $query_ende + "Nachname=\'$nachname\'"; 
		}
		if($geburtastag)
		{
			$query = $query + ',Geburstag';	// nachschauen ob es wirklich so heißt
			$query_ende = $query_ende + "Geburstatg=\'$geburtastag\'"; // evtl. vorher umformen zum type tiemstamp
		}
		if($plz)
		{
			$query = $query + ',Plz';
			$query_ende = $query_ende + "Plz=\'$plz\'"; 
		}
		
		// Jetzt kommt die eignetliche abfrage
		$DBanswer = $this->db->query($query+$query_ende);
		
		
		return $DBanswer;
	}

	public function addUser($data)
	{	//Daten als array übergeben, einfacher zu händeln, bei fehlenden positionen
		/*
		 * $vorname=false,$nachname=false,$strasse=false,$hausnummer=false,$plz=false,
							$geburtstag=false,$beruf=false,$arbeitszeiten=false,$jrkmitglied=false,
							$faehigkeiten=false,$bevorzugteKom=false,$anmerkung=false,$facebook=false,
							$geschlecht=false,$mitgliedSeit=false,$besonderheiten=false,
							$fuehrerschein=false,$erweiteresZeugnis=false,$vorgelegt=false,
							$foermlich=false
		 */
		 if( (empty($data['vorname']) || $data['vorname'] == false) || (empty($data['nachname']) || $data['nachname'] == false))
		 {
		 	return false;
		 } 
		 
	}
}
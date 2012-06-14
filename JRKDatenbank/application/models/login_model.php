<?php
class login_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	/*
	 * function check_user takes the Username and transforme it to lowercase + take the hased and salted PW
	 * returns if exists the DBUserID
	 */
	public function check_user($userName = FALSE, $userPW = FALSE) {

		if ($userName == FALSE || $userPW == FALSE) {
			return FALSE;
		}

		$userName = strtolower($userName);

		$query = "SELECT ID FROM `dbuser` WHERE Name='$userName' AND Passwort='$userPW'";

		$DBAnswer = $this -> db -> query($query);

		if ($tmp = $this -> db -> affected_rows() != 1) {
			return FALSE;
		}// wenn es weniger oder mehr als ein result kommt, abbrechen

		$DBAnswer = $DBAnswer -> result_array();

		return $DBAnswer[0]['ID'];
	}
	
	public function isAdminfromUsername($userName = FALSE){
		if($userName == FALSE){
			return FALSE;
		}
		
		$query = "SELECT ID FROM `dbuser` WHERE Name='$userName'";
		
		$DBAnswer = $this->db->query($query);
		
		if ($tmp = $this -> db -> affected_rows() != 1) {
			return FALSE;
		}// wenn es weniger oder mehr als ein result kommt, abbrechen
		
		$DBAnswer = $DBAnswer -> result_array();
		
		return $this->isAdmin($DBAnswer[0]['ID']);
	}

	public function isAdmin($UserID = FALSE) {
		if (!$UserID) {
			return FALSE;
		}

		$query = "SELECT Admin FROM `dbuser` WHERE ID=$UserID";

		$DBAnswer = $this -> db -> query($query);

		if ($tmp = $this -> db -> affected_rows() != 1) {
			return FALSE;
		}// wenn es weniger oder mehr als ein result kommt, abbrechen

		$DBAnswer = $DBAnswer -> result_array();
		if ($DBAnswer[0]['Admin'] == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>

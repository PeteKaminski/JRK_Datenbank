<?php
class Dbuser_model extends CI_Model {

    public function __construct() {
        $this -> load -> database();
    }

    /*
     * function check_user takes the Username and transforme it to lowercase + take the hased and salted PW
     * returns if exists the DBUserID
     */
    public function check_user($userID = FALSE, $userPW = FALSE) {

        if ($userID == FALSE || $userPW == FALSE) {
            return FALSE;
        }

        if (!is_numeric($userID)) {
            $userID = $this -> getIDfromUsername($userID);
        }

        if ($userID == 0) {
            return FALSE;
        }

        $query = "SELECT ID FROM `dbuser` WHERE ID=$userID AND Passwort='$userPW'";

        $DBAnswer = $this -> db -> query($query);

        if ($tmp = $this -> db -> affected_rows() != 1) {
            return FALSE;
        }// wenn es weniger oder mehr als ein result kommt, abbrechen

        $DBAnswer = $DBAnswer -> result_array();

        return $DBAnswer[0]['ID'];
    }

    public function getIDfromUsername($userName = FALSE) {
        if ($userName == FALSE) {
            return FALSE;
        }
        
        $userName = strtolower($userName);
        
        $query = "SELECT ID FROM `dbuser` WHERE Name='$userName'";

        $DBAnswer = $this -> db -> query($query);

        if ($tmp = $this -> db -> affected_rows() != 1) {
            return FALSE;
        }// wenn es weniger oder mehr als ein result kommt, abbrechen

        $DBAnswer = $DBAnswer -> result_array();

        return $DBAnswer[0]['ID'];
    }

    public function isAdmin($UserID = FALSE) {
        if ($userID == FALSE) {
            return FALSE;
        }

        if (!is_numeric($userID)) {
            $userID = $this -> getIDfromUsername($userID);
        }

        if ($userID == 0) {
            return FALSE;
        }

        $query = "SELECT ID FROM `dbuser` WHERE ID=$UserID AND Admin=1";

        $DBAnswer = $this -> db -> query($query);

        if ($tmp = $this -> db -> affected_rows() != 1) {
            return FALSE;
        }// wenn es weniger oder mehr als ein result kommt, abbrechen

        $DBAnswer = $DBAnswer -> result_array();

        if ($DBAnswer[0]['ID'] == $UserID) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function addUser($userName = FALSE, $userPW = FALSE, $isAdmin = FALSE) {
        if (!$userName || !$userPW) {
            return FALSE;
        }

        if ($isAdmin) {
            $isAdmin = 1;
        } else {
            $isAdmin = 0;
        }
        $query = "INSERT INTO `dbuser` (Name, Passwort, Admin) VALUES ('$userName', '$userPW', $isAdmin);";

        $DBAnswer = $this -> db -> query($query);

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

        if (!is_numeric($userID)) {
            $userID = $this -> getIDfromUsername($userID);
        }

        if ($userID == 0) {
            return FALSE;
        }

        $query = "DELETE FROM `dbuser` WHERE ID = $userID";

        $DBAnswer = $this -> db -> query($query);

        if ($this -> db -> affected_rows() != 1) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    

    public function changePW($userID = FALSE, $oldPW, $newPW) {
        if ($userID == FALSE) {
            return FALSE;
        }

        if (!is_numeric($userID)) {
            $userID = $this -> getIDfromUsername($userID);
        }

        if ($userID == 0) {
            return FALSE;
        }
        
        if(!isset($oldPW) || !isset($newPW)){
            return FALSE;
        }
        
        if( ! $this->check_user($userID, $oldPW)){
            return FALSE;
        }
        
        $query = "UPDATE `dbuser`SET Passwort='$newPW' WHERE ID=$userID";
        
        $DBAnswer = $this->db->query($query);
        
        if($this -> db -> affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
?>

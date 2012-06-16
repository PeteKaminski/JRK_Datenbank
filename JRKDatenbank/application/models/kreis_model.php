<?php

class Kreis_model extends CI_Model {

    function __construct() {

        $this -> load -> database();
    }

    function getKreisverband($kreisID = FALSE) {
        if ($kreisID == FALSE) {
            return FALSE;
        }

        /* Bsp. fuer SQL WHERE query
         * SELECT * FROM Persons WHERE UserID=1;
         */

        $query = "SELECT * FROM `kreisverband` WHERE KreisverbandID = $kreisID;";

        $DBAnswer = $this -> db -> query($query);

        $DBAnswer = $DBAnswer -> result_array();

        If (defined('DEBUG')) {
            echo '<div id="debug">';
            echo "<p>[getKreisverband] input: \$kreisID = $kreisID;</p>";
            echo "<p>SQL Query [getKreisverband]: " . $query . '</p>';
            echo "<p>SQL Antwort  [getKreisverband]: </p>";
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            return $DBAnswer[0];
        } else {
            return FALSE;
        }
        return $data;
    }

    private function prepareArray($data, $keys) {
        foreach ($keys as $key => $value) {
            if ((!isset($data[$value])) || empty($data[$value])) {
                $data[$value] = false;
            }
        }
        return $data;
    }
    
        public function updateKreisverband($kreisID = FALSE, $data){
        if( !$kreisID ){
            return FALSE;
        }
        //KreisverbandID    Abkuerzung  Kreisjugendleiter   Kreisjugendleiter2  Ortsteil    Ort     Strasse     Hausnr  Plz 
        $data = $this->prepareArray($data, array('Abkuerzung', 'Kreisjugendleiter', 'Kreisjugendleiter2', 'Ortsteil', 'Ort', 'Strasse', 'Hausnr', 'Plz'));
        
        if(is_numeric($kreisID)){
            return $this->updateKreis($kreisID, $data);
        }else{
            return $this->createKreis($data);
        }
    }

    private function createKreis($data) {

        $query_front = 'INSERT INTO `kreisverband` (';
        $query_back = 'VALUES (';

        // fuer den ersten DB-Wert, damit er kein Komma schreibt
        $isNotFirstEntry = FALSE;

        if ($data['Abkuerzung'] == FALSE || $data['Ortsteil'] == FALSE) {
            return false;
        }

        foreach ($data as $key => $value) {
            if ($value) {
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
            echo "<p>[createKreis] input:</p>";
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            echo "<p>SQL Query [createKreis]: " . $query_front . $query_back . '</p>';
            echo "<p>SQL Antwort  [createKreis]: " . $this -> db -> insert_id() . '</p>';
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            return $this -> db -> insert_id();
        } else {
            return FALSE;
        }
    }
    
    private function updateKreis($kreisID = FALSE, $data){
        /*
         * SQL UPDATE Bsp.: UPDATE Persons SET Address='Nissestien 67', City='Sandnes'
         * WHERE LastName='Tjessem' AND FirstName='Jakob'
         */
         $query_front = 'UPDATE `kreisverband` SET ';
        $query_back = "WHERE    KreisverbandID=$kreisID";

        // fuer den ersten DB-Wert, damit er kein Komma schreibt
        $isNotFirstEntry = FALSE;

        foreach ($data as $key => $value) {
            if ($value) {
                if ($isNotFirstEntry) {
                    $query_front = $query_front.", $key='$value'";
                } else {
                    $query_front = $query_front." $key='$value'";
                    $isNotFirstEntry = TRUE;
                }
            }
        }
        $DBAnswer = $this -> db -> query($query_front . $query_back);

        If (defined('DEBUG')) {
            echo '<div id="debug">';
            echo "<p>[updateKreis] input:</p>";
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            echo "<p>SQL Query [updateKreis]: " . $query_front . $query_back . '</p>';
            echo "<p>SQL Antwort  [updateKreis]: " . $this -> db -> affected_rows(). '</p>';
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            if($this -> db -> affected_rows() > 0){
                return TRUE;   
            }            
        } else {
            return FALSE;
        }
    }
}
?>
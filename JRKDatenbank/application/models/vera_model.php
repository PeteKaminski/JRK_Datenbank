<?php

class Vera_model extends CI_Model {

    var $title = '';
    var $content = '';
    var $date = '';

    function __construct() {
        // Call the Model constructor
        //parent::__construct();
        $this -> load -> database();
    }

    function getVeranstaltung($verID = FALSE) {
        if ($verID == FALSE) {
            return FALSE;
        }

        /* Bsp. fuer SQL WHERE query
         * SELECT * FROM Persons WHERE UserID=1;
         */

        $query = "SELECT * FROM `veranstaltung` WHERE VeranstaltungID = $verID;";

        $DBAnswer = $this -> db -> query($query);

        $DBAnswer = $DBAnswer -> result_array();

        If (defined('DEBUG')) {
            echo '<div id="debug">';
            echo "<p>[getVeranstaltung] input: \$verID = $verID;</p>";
            echo "<p>SQL Query [getVeranstaltung]: " . $query . '</p>';
            echo "<p>SQL Antwort  [getVeranstaltung]: </p>";
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

    public function transformToTimestamp($year = FALSE, $month = FALSE, $day = FALSE, $hour = FALSE, $minute = FALSE) {
        if (!$year || !$month || !$day || !$hour || !$minute) {
            return FALSE;
        }

        // Bsp.: '2005-05-13 07:15:31'

        return "$year-$month-$day $hour:$minute:00";
    }

    public function transformFromTimestamp($timestamp = FALSE) {
        if (!$timestamp) {
            return FALSE;
        }

        // Bsp.: '2005-05-13 07:15:31'

        $tmp = explode(' ', $timestamp);
        if (count($tmp) < 2) {
            return FALSE;
        }

        $year = explode('-', $tmp[0]);
        if (count($year) < 3) {
            return FALSE;
        }

        $time = explode(':', $tmp[1]);
        if (count($time) < 3) {
            return FALSE;
        }

        $result = array('Jahr' => $year[0], 'Monat' => $year[1], 'Tag' => $year[2], 'Stunde' => $time[0], 'Minute' => $time[1], 'Sekunde' => $time[2]);

        return $result;
    }

    public function updateVeranstaltung($veraID = FALSE, $data){
        if( !$veraID ){
            return FALSE;
        }
        
        $data = $this->prepareArray($data, array('Thema', 'Art', 'Name', 'Ort', 'Strasse', 'Plz', 'Hausnr', 'DatumBegin', 'DatumEnde', 'MaxTeilnehmer', 'Leistung', 'TnBeitrag'));
        
        if(is_numeric($veraID)){
            return $this->updateVera($veraID, $data);
        }else{
            return $this->createVera($data);
        }
    }

    private function createVera($data) {
        //$data = $this -> prepareArray($data, array('Thema', 'Art', 'Name', 'Ort', 'Strasse', 'Plz', 'Hausnr', 'DatumBegin', 'DatumEnde', 'MaxTeilnehmer', 'Leistung', 'TnBeitrag'));

        $query_front = 'INSERT INTO `veranstaltung` (';
        $query_back = 'VALUES (';

        // fuer den ersten DB-Wert, damit er kein Komma schreibt
        $isNotFirstEntry = FALSE;

        if ($data['Thema'] == FALSE || $data['Art'] == FALSE || $data['Name'] == FALSE || $data['Ort'] == FALSE || $data['DatumBegin'] == FALSE || $data['DatumEnde'] == FALSE || $data['MaxTeilnehmer'] == FALSE || $data['TnBeitrag'] == FALSE || $data['Leistung'] == FALSE) {
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
            echo "<p>[createVera] input:</p>";
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            echo "<p>SQL Query [createVera]: " . $query_front . $query_back . '</p>';
            echo "<p>SQL Antwort  [createVera]: " . $this -> db -> insert_id() . '</p>';
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            return $this -> db -> insert_id();
        } else {
            return FALSE;
        }
    }
    
    private function updateVera($veraID = FALSE, $data){
        /*
         * SQL UPDATE Bsp.: UPDATE Persons SET Address='Nissestien 67', City='Sandnes'
         * WHERE LastName='Tjessem' AND FirstName='Jakob'
         */
         $query_front = 'UPDATE `veranstaltung` SET ';
        $query_back = "WHERE VeranstaltungID=$veraID";

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
            echo "<p>[updateVera] input:</p>";
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            echo "<p>SQL Query [updateVera]: " . $query_front . $query_back . '</p>';
            echo "<p>SQL Antwort  [updateVera]: " . $this -> db -> affected_rows(). '</p>';
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            if($this -> db -> affected_rows() > 0){
                return TRUE;   
            }            
        } else {
            return FALSE;
        }
        return true;
    }

}
?>
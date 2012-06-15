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
            echo "[getVeranstaltung] input: \$verID = $verID;";
            echo "SQL Query [getVeranstaltung]: " . $query;
            echo "SQL Antwort  [getVeranstaltung]: " . $DBAnswer;
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

    function updateVeranstaltung($data) {
        $data = $this -> prepareArray($data, array('Thema', 'Art', 'Name', 'Ort', 'Strasse', 'Plz', 'Hausnr', 'DatumBegin', 'DatumEnde', 'MaxTeilnehmer', 'Leistung', 'TnBeitrag'));

        $query_front = 'INSERT INTO User (';
        $query_back = 'VALUES (';

        // fuer den ersten DB-Wert, damit er kein Komma schreibt
        $isNotFirstEntry = FALSE;

        if ($data['Thema'] == FALSE || $data['Art'] == FALSE || $data['Name'] == FALSE || $data['Ort'] == FALSE || $data['DatumBegin'] == FALSE || $data['DatumEnde'] == FALSE || $data['MaxTeilnehmer'] == FALSE || $data['TnBeitrag'] == FALSE || $data['ArtMassnahme'] == FALSE) {
            return false;
        }

        foreach ($data as $key => $value) {
            if ($value) {/*
                 * Sonderfaell berachten fuer BOOL und INT
                 * DATE ggf. wandeln
                 */

                switch ($key) {
                    case 'Thema' || 'Plz' || 'DatumBegin' || 'DatumEnde' || 'MaxTeilnehmer' || 'TnBeitrag':
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
            echo "<p>[addUser] input:</p>";
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            echo "<p>SQL Query [addUser]: " . $query_front . $query_back . '</p>';
            echo "<p>SQL Antwort  [addUser]: " . $this -> db -> insert_id() . '</p>';
            echo '</div>';
        }

        if ($DBAnswer != 0) {
            return $this -> db -> insert_id();
        } else {
            return FALSE;
        }
        return true;
    }

}
?>
<?php

class Vera_model extends CI_Model 
{

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this -> load -> database();
    }
    
	function getVeranstaltung($verID)
	{
		/*
		 * TODO hier muss nun die datenbankabfrage kommen.
		 */
		
		$data = array(
		'Name' => 'Name',
	    'Traeger' => 'Traeger',
	    // 'Thema' => set_value('Thema'),
	    // 'ArtMassnahme' => '',
	    // 'Strasse' => set_value('Strasse'),
	    // 'HausNr' => set_value('HausNr'),
	    // 'PLZ' => set_value('PLZ'),
	    // 'Ort' => set_value('Ort'),
	    // 'DatumBegintag' => set_value('DatumBegintag'),
	    // 'DatumBeginmonat' => set_value('DatumBeginmonat'),
	    // 'DatumBeginjahr' => set_value('DatumBeginjahr'),
	    // 'DatumEndetag' => set_value('DatumEndetag'),
	    // 'DatumEndemonat' => set_value('DatumEndemonat'),
	    // 'DatumEndejahr' => set_value('DatumEndejahr'),
	    // 'MaxTeilnehmer' => set_value('MaxTeilnehmer'),
	    // 'Leistung' => set_value('Leistung'),
	    // 'TeilnehmerBeitrag' => set_value('TeilnehmerBeitrag'),
	    // 'Besonderheiten' => set_value('Besonderheiten'),
	    );
		return $data;
	}
    
	function updateVeranstaltung($data)
	{
		/*
		 * TODO hier kommt update Veranstaltungs Daten.
		 */
		return true;
	}
}
?>
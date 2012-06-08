<?php
/*
 * Example aufruf DayValue(geburts,13,4,2011);
 */
function DayValue($parameters)
{
	$parameter=$parameters['parameter'];
	//für Tag
	echo "\n<select name=\"".$parameter['name']."tag\">\n";
	for($i=1;$i<=31;$i++) {
		echo "\t<option value=\"". $i ."\""; 
		if ($parameter['tag'] == $i )
		 	echo ' selected="selected" ';
		echo ">". $i ."</option>\n"; 
	}
	echo "</select>\n";
	
	//für Monat
	echo "\n<select name=\"".$parameter['name']."monat\">\n";
	for($i=1;$i<=12;$i++) {
		echo "\t<option value=\"". $i ."\""; 
		if ($parameter['monat'] == $i )
		 	echo ' selected="selected" ';
		echo ">". $i ."</option>\n"; 
	}
	echo "</select>\n";
	
	//für Jahr
	echo "\n<select name=\"".$parameter['name']."jahr\">\n";
	for($i=1920;$i<=2020;$i++) {
		echo "\t<option value=\"". $i ."\""; 
		if ($parameter['jahr'] == $i )
		 	echo ' selected="selected" ';
		echo ">". $i ."</option>\n"; 
	}
	echo "</select>\n";
}

function GeschlechtValue($parameters)
{
	$parameter=$parameters['parameter'];
	foreach ($parameter['optionen'] as $element ) {
		echo '<input type="radio" name="'.$parameter['id'].'" value="'.$element.'"'; 
		if ($parameter['checked'] == $element)
		echo ' checked="checked" ';
		echo '>'.$element;
	}	
}

function TelefonEmailValue($parameter)
{
	echo form_dropdown($parameter['html']['id'],$parameter['type'],$parameter['selected']);
	echo " ";
	echo form_input($parameter['html']);
}

function getuserformarray()
	{ 
		$userform = array(
			'Foermlich'=>array(
				'mytype' => 'checkbox',
				'html' => array(
					'name' => 'F&ouml;rmlich:',
					'id' => 'foermlich',
					'checked' => TRUE,
				)
			),
			'Name'=>array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Name:',
					'id' => 'Name',
					'maxlength' => '100',
				)
			),
			'Vorname' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Vorname:',
					'id' => 'Vorname',
					'maxlength' => '100',
				)
			),
			'Strasse' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Stra&szlig;e:',
					'id' => 'Strasse',
					'maxlength' => '100',
				)
			),
			'HausNr' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Hausnummer:',
					'id' => 'HausNr',
					'maxlength' => '100',
				)
			),
			'Plz' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'PLZ:',
					'id' => 'Plz',
					'maxlength' => '100',
				)
			),
			'Ort' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Ort:',
					'id' => 'Ort',
					'maxlength' => '100',
				)
			),
			'Bezirk' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Bezirk:',
					'id' => 'Bezirk',
					'maxlength' => '100',
				)
			),
			'Geburtstag' => array(
				'mytype' => 'function',
				'html' => array(
					'name' => 'Geburtstag:',
					'id' => 'geburtstag',
				),
				'funcname' => 'DayValue',
				'parameter' =>array(
					'name' => 'Geburts',
					'tag' => '1',
					'monat' => '1',
					'jahr' => '2000',
				),
			),
			'Geschlecht' => array(
				'mytype' => 'function',
				'html' => array(
					'name' => 'Geschlecht:',
					'id' => 'geschlecht',
				),
				'funcname' => 'GeschlechtValue',
				'parameter' => array(
					'id' => 'Geschlecht',
					'checked' => 'm',
					'optionen' => array(
						'm' => 'm',
						'w' => 'w',			
					),					
				),
			),
			'Beruf' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Beruf:',
					'id' => 'Beruf',
					'maxlength' => '100',
				)
			),
			'Arbeitszeit' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Arbeitszeit:',
					'id' => 'Arbeitszeit',
					'maxlength' => '80',
				)
			),
			'TelefonNr0' => array(
				'mytype' => 'function',
				'funcname' => 'TelefonEmailValue',
				'html' => array(
					'name' => 'Telefonnummer:',
					'id' => 'TelefonNr0',
					'maxlength' => '100',
				),
				'type' => array(
					'Arbeit' => 'Arbeit',
					'Privat' => 'Privat',
					'Mobil' => 'Mobil',
				),
				'selected' => 'Privat',
			),
			'Email0' => array(
				'mytype' => 'function',
				'funcname' => 'TelefonEmailValue',
				'html' => array(
					'name' => 'Email:',
					'id' => 'Email0',
					'maxlength' => '100',
				),
				'type' => array(
					'Arbeit' => 'Arbeit',
					'Privat' => 'Privat',
					'Mobil' => 'Mobil',
				),
				'selected' => 'Privat',
			),
			'Facebook' => array(
				'mytype' => 'text',
				'html' => array(
					'name' => 'Facebook:',
					'id' => 'Facebook',
					'maxlength' => '100',
				)
			),
			'BevorzugteKommunikation' => array(
				'mytype' => 'dropdown',
				'html' => array(
					'name' => 'Bevorzugte Kommunikation:',
					'id' => 'BevorzugteKommunikation',
				),
				'values' => array(
					'Telefon' => 'Telefon',
					'Email' => 'Email',
					'Facebook' => 'Facebook',
					'Post' => 'Post',
				),
				'selected' => 'Email',
			),
			'MitgliedSeid' => array(
				'mytype' => 'function',
				'html' => array(
					'name' => 'Mitglied seid:',
					'id' => 'MitgliedSeid',
				),
				'funcname' => 'DayValue',
				'parameter' =>array(
					'name' => 'MitgliedSeid',
					'tag' => '1',
					'monat' => '1',
					'jahr' => '2000',
				),
			),
			'Kreisverband' => array(
				'mytype' => 'dropdown',
				'html' => array(
					'name' => 'Kreisverband:',
					'id' => 'Kreisverband',
				),
				'values' => array(
					'1' => 'lala',
					'3' => 'tratra',
					'4' => 'hihi',
				),
				'selected' => '4',
			),
			'Besonderheiten' => array(
				'mytype' => 'textarea',
				'html' => array(
					'name' => 'Besonderheiten:',
					'id' => 'Besonderheiten',
					'maxlength' => '1000',
					'rows' => '20',
					'cols' => '50'
				)
			),
			
			
		);
	return $userform;
		
	}
?>
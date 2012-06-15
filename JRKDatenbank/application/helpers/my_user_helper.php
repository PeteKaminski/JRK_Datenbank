<?php
/*
 * Example aufruf DayValue(geburts,13,4,2011);
 */
function DayValue($parameters)
{
	$txt = "";
	// TODO: umbedingt nochmal Ändern 
	$parameter=$parameters['parameter'];
	//für Tag
	$txt .=  "\n<select name=\"".$parameter['name']."tag\">\n";
	for($i=1;$i<=31;$i++) {
		$txt .=  "\t<option value=\"". $i ."\""; 
		if ($parameter['tag'] == $i )
		 	$txt .=  ' selected="selected" ';
		$txt .=  ">". $i ."</option>\n"; 
	}
	$txt .=  "</select>\n";
	
	//für Monat
	$txt .=  "\n<select name=\"".$parameter['name']."monat\">\n";
	for($i=1;$i<=12;$i++) {
		$txt .=  "\t<option value=\"". $i ."\""; 
		if ($parameter['monat'] == $i )
		 	$txt .=  ' selected="selected" ';
		$txt .=  ">". $i ."</option>\n"; 
	}
	$txt .=  "</select>\n";
	
	//für Jahr
	$txt .=  "\n<select name=\"".$parameter['name']."jahr\">\n";
	for($i=1920;$i<=2020;$i++) {
		$txt .=  "\t<option value=\"". $i ."\""; 
		if ($parameter['jahr'] == $i )
		 	$txt .=  ' selected="selected" ';
		$txt .=  ">". $i ."</option>\n"; 
	}
	$txt .=  "</select>\n";
	return $txt;
}

function GeschlechtValue($parameters)
{
	$txt = "";
	$parameter=$parameters['parameter'];
	foreach ($parameter['optionen'] as $element ) {
		$txt .=  '<input type="radio" name="'.$parameter['id'].'" value="'.$element.'"'; 
		if ($parameter['checked'] == $element)
		$txt .=  ' checked="checked" ';
		$txt .=  '>'.$element;
	}	
	return $txt;
}

function TelefonEmailValue($parameter)
{
	$txt = "";
	$txt .= form_dropdown($parameter['html']['id'],$parameter['type'],$parameter['selected']);
	$txt .=  " ";
	$txt .=  form_input($parameter['html']);
	return $txt;
}

function printPosition ($element)
{
	$txt = "";
	$positionArr = $element['parameter']['positionArr'];
	$selected  = $element['parameter']['selected'];
	$von['parameter'] = $element['parameter']['von'];
	$bis['parameter'] = $element['parameter']['bis'];
	
	$txt .=  form_dropdown($element['html']['id'],$positionArr,$selected);
	$txt .=  " von ";
	DayValue($von);
	$txt .=  " bis ";
	DayValue($bis);
	return $txt;
}

function printQualli($parameter)
{
	$txt = "";
	$selectedQualli = $parameter['selected'];
	$quallifikationen = $parameter['quallifikationsArr'];
	foreach($selectedQualli as $key => $element)
	{
		$txt .=  "\n<select name=\"".$parameter['html']['id'].$key."\">\n";
		foreach($quallifikationen as $keyq => $qualli) {
			$txt .=  "\t<option value=\"". $qualli ."\""; 
			if ($element == $keyq) //wenn der index des qualliarrays gleich dem aktuellem selected element ist.
			 	$txt .=  ' selected="selected" ';
			$txt .=  ">". $qualli ."</option>\n";
		}
		$txt .=  "</select></br>\n"; 
	}
	return $txt;
}


function printFuehZeug ($parameter)
{
	$txt = "";
	$date['parameter'] = $parameter['date'];
	$txt .=  form_checkbox($parameter['html']);
	$txt .=  " vorgelegt am: ";
	DayValue($date);
	return $txt;
}


function getuserformarray()
	{ 
		$userform = array(
			'Foermlich'=>array(
				'htmltype' => 'checkbox',
				'html' => array(
					'name' => 'F&ouml;rmlich:',
					'id' => 'foermlich',
					'checked' => TRUE,
				)
			),
			'Name'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Name:',
					'id' => 'Name',
					'value' => 'Walter',
					'maxlength' => '100',
				)
			),
			'Vorname' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Vorname:',
					'id' => 'Vorname',
					'maxlength' => '100',
				)
			),
			'Strasse' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Stra&szlig;e:',
					'id' => 'Strasse',
					'maxlength' => '100',
				)
			),
			'HausNr' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Hausnummer:',
					'id' => 'HausNr',
					'maxlength' => '100',
				)
			),
			'Plz' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'PLZ:',
					'id' => 'Plz',
					'maxlength' => '100',
				)
			),
			'Ort' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Ort:',
					'id' => 'Ort',
					'maxlength' => '100',
				)
			),
			'Bezirk' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Bezirk:',
					'id' => 'Bezirk',
					'maxlength' => '100',
				)
			),
			'Geburtstag' => array(
				'htmltype' => 'function',
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
				'htmltype' => 'function',
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
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Beruf:',
					'id' => 'Beruf',
					'maxlength' => '100',
				)
			),
			'Arbeitszeit' => array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Arbeitszeit:',
					'id' => 'Arbeitszeit',
					'maxlength' => '80',
				)
			),
			'TelefonNr0' => array(
				'htmltype' => 'function',
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
				'htmltype' => 'function',
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
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Facebook:',
					'id' => 'Facebook',
					'maxlength' => '100',
				)
			),
			'BevorzugteKommunikation' => array(
				'htmltype' => 'dropdown',
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
				'htmltype' => 'function',
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
				'htmltype' => 'dropdown',
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
			'Position1' => array(
				'html' => array(
					'name' => 'Position:',
					'id' => 'Position1',
					),
				'htmltype' =>'function',
				'funcname' => 'printPosition',
				'parameter' =>array(
					'positionArr' => array(
						'1' => 'JRKP',
						'2' => 'Gruppenf&uuml;hrer',
						'3' => 'Erste Hilfe',
						),
					'selected' => '2',
					'von' => array(
						'name' => 'Position1von',
						'tag' => '1',
						'monat' => '1',
						'jahr' => '2000',
					),
					'bis' => array(
						'name' => 'Position2bis',
						'tag' => '1',
						'monat' => '1',
						'jahr' => '2000',
					),
				),
			),
			'Quallifikation' => array(
				'htmltype' => 'function',
				'funcname' => 'printQualli',
				'html' => array(
					'name' => 'Quallifikation:',
					'id' => 'Quallifikation',
				),
				'quallifikationsArr' => array(
					'1' => 'lala',
					'2' => 'lata',
					'3' => 'tratra',
					'4' => 'hihi',
				),
				'selected' => array(
					'1' =>	'2',
					'2' =>  '4',
				),
			),
			'IQuallifikation' => array(
				'htmltype' => 'function',
				'funcname' => 'printQualli',
				'html' => array(
					'name' => 'Intressierte Quallifikationen:',
					'id' => 'IQuallifikation',
				),
				'quallifikationsArr' => array(
					'1' => 'lala',
					'2' => 'lata',
					'3' => 'tratra',
					'4' => 'hihi',
				),
				'selected' => array(
					'1' =>	'2',
					'2' =>  '4',
				),
			),
			'Faehigkeiten' => array(
				'htmltype' => 'textarea',
				'html' => array(
					'name' => 'F&auml;higkeiten:',
					'id' => 'Faehigkeiten',
					'maxlength' => '1000',
					'rows' => '8',
					'cols' => '50',
				),
			),
			'Anmerkungen' => array(
				'htmltype' => 'textarea',
				'html' => array(
					'name' => 'Anmerkungen:',
					'id' => 'Anmerkungen',
					'maxlength' => '10000',
					'rows' => '8',
					'cols' => '50',
				),
			),
			'Fuehrerschein'=>array(
				'htmltype' => 'checkbox',
				'html' => array(
					'name' => 'F&uuml;hrerschein:',
					'id' => 'Fuehrerschein',
					'checked' => TRUE,
				)
			),
			'ErweitertesFuehrungszeugnis' => array(
				'html' => array(
					'name' => 'Erweitertes Fuehrungszeugnis:',
					'id' => 'ErweitertesFuehrungszeugnis',
					'checked' => true,
					),
				'htmltype' =>'function',
				'funcname' => 'printFuehZeug',
				'date' => array(
					'name' => 'ErweitertesFuehrungszeugnis',
					'tag' => '1',
					'monat' => '1',
					'jahr' => '2000',
				),
			),
			'Besonderheiten' => array(
				'htmltype' => 'textarea',
				'html' => array(
					'name' => 'Besonderheiten:',
					'id' => 'Besonderheiten',
					'maxlength' => '1000',
					'rows' => '8',
					'cols' => '50',
				),
			),			
		);
	return $userform;
		
	}
?>
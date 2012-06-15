<h3>Hinzuf&uuml;gen einer Veranstaltung.</h3>

<?php 
//echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');
	

if (!isset($_POST['Speichern']))
{
	if($VeranstaltungID != 'new')
	{
	echo 'Lade daten aus der Datenbank';
	
	$vdata = array(
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
	}
		else
	{
		echo 'Default Value gesetzt';
		$vdata = array(
		'Name' => 'Name',
	    'Traeger' => 'Senat',
	    'Thema' => '',
	    'ArtMassnahme' => '',
	    'Strasse' => '',
	    'HausNr' => '',
	    'Plz' => '',
	    'Ort' => '',
	    'DatumBegintag' => '',
	    'DatumBeginmonat' => '',
	    'DatumBeginjahr' => '',
	    'DatumEndetag' => '',
	    'DatumEndemonat' => '',
	    'DatumEndejahr' => '',
	    'MaxTeilnehmer' => '',
	    'Leistung' => '',
	    'TeilnehmerBeitrag' => '',
	    'Besonderheiten' => '',
	    );
	}
}
else 
{
	echo 'Setze setValue variablen.';
	$vdata = array(
		'Name' => set_value('Name'),
	    'Traeger' => set_value('Traeger'),
	    'Thema' => set_value('Thema'),
	    'ArtMassnahme' => set_value('ArtMassnahme'),
	    'Strasse' => set_value('Strasse'),
	    'HausNr' => set_value('HausNr'),
	    'Plz' => set_value('Plz'),
	    'Ort' => set_value('Ort'),
	    'DatumBegintag' => set_value('DatumBegintag'),
	    'DatumBeginmonat' => set_value('DatumBeginmonat'),
	    'DatumBeginjahr' => set_value('DatumBeginjahr'),
	    'DatumEndetag' => set_value('DatumEndetag'),
	    'DatumEndemonat' => set_value('DatumEndemonat'),
	    'DatumEndejahr' => set_value('DatumEndejahr'),
	    'MaxTeilnehmer' => set_value('MaxTeilnehmer'),
	    'Leistung' => set_value('Leistung'),
	    'TeilnehmerBeitrag' => set_value('TeilnehmerBeitrag'),
	    'Besonderheiten' => set_value('Besonderheiten'),
		);	
}	
	
	$veranstaltungform = array(
			'Name'=>array(
				'htmltype' => 'text',
				'name' => 'Name:',
				'html' => array(
					'name' => 'Name',			//Name von oben
					'id' => 'Name',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
					'value' => $vdata['Name'],
				)
			),
			'Traeger'=>array(
				'htmltype' => 'text',
				'name' => 'Traeger:',
				'html' => array(
					'name' => 'Traeger',			//Name von oben
					'id' => 'Traeger',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
					'value' => $vdata['Traeger'],
				)
			),
			'Thema'=>array(
				'htmltype' => 'text',
				'name' => 'Thema:',
				'html' => array(
					'name' => 'Thema',			//Name von oben
					'id' => 'Thema',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
					'value' => $vdata['Thema'],
				)
			),
			'ArtMassnahme' => array(
				'htmltype' => 'dropdown',
				'name' => 'Art Massnahme:',
				'html' => array(
					'name' => 'ArtMassnahme',
					'id' => 'ArtMassnahme',
				),
				'values' => array(
					'Kurs' => 'Kurs',
					'Internationale Begegnung' => 'Internationale Begegnung',
					'Ferienmassnahme' => 'Ferienmassnahme',
				),
				'selected' => $vdata['ArtMassnahme'],
			),
			'Strasse' => array(
				'htmltype' => 'text',
				'name' => 'Stasse:',
				'html' => array(
					'name' => 'Strasse',
					'id' => 'Strasse',
					'maxlength' => '100',
					'value' => $vdata['Strasse'],
				)
			),
			'HausNr' => array(
				'htmltype' => 'text',
				'name' => 'Hausnummer:',
				'html' => array(
					'name' => 'HausNr',
					'id' => 'HausNr',
					'maxlength' => '100',
					'value' => $vdata['HausNr'],
				)
			),
			'Plz' => array(
				'htmltype' => 'text',
				'name' => 'PLZ:',
				'html' => array(
					'name' => 'Plz',
					'id' => 'Plz',
					'maxlength' => '100',
					'value' => $vdata['Plz'],
				)
			),
			'Ort' => array(
				'htmltype' => 'text',
				'name' => 'Ort:',
				'html' => array(
					'name' => 'Ort',
					'id' => 'Ort',
					'maxlength' => '100',
					'value' => $vdata['Ort'],
				)
			),
			'DatumBegin' => array(
				'htmltype' => 'function',
				'funcname' => 'DayValue',
				'name' => 'DatumBegin:',
				'html' => array(
					'name' => 'DatumBegin',	//Anzeige Beschreibungsname 
					'id' => 'DatumBegin',		//wie name nur kleingeschrieben
				),
				'parameter' =>array(
					'name' => 'DatumBegin',		//Wie Oben
					'tag' => $vdata['DatumBegintag'],				//voreingestellter Tag
					'monat' => $vdata['DatumBeginmonat'],				//voreingestellter monat
					'jahr' => $vdata['DatumBeginjahr'],			//voreingestellter jahr
				),
			),
			'DatumEnde' => array(
				'htmltype' => 'function',
				'funcname' => 'DayValue',
				'name' => 'DatumEnde:',
				'html' => array(
					'name' => 'DatumEnde',		//Anzeige Beschreibungsname 
					'id' => 'DatumEnde',		//wie name nur kleingeschrieben
					
				),
				'parameter' =>array(
					'name' => 'DatumEnde',		//Wie Oben
					'tag' => $vdata['DatumEndetag'],				//voreingestellter Tag
					'monat' => $vdata['DatumEndemonat'],				//voreingestellter monat
					'jahr' => $vdata['DatumEndejahr'],			//voreingestellter jahr
				),
			),
			'MaxTeilnehmer' => array(
				'htmltype' => 'text',
				'name' => 'Maximale Teilnehmer:',
				'html' => array(
					'name' => 'MaxTeilnehmer',
					'id' => 'MaxTeilnehmer',
					'maxlength' => '100',
					'value' => $vdata['MaxTeilnehmer'],
				),
			),
			'Leistung' => array(
				'htmltype' => 'text',
				'name' => 'Leistung:',
				'html' => array(
					'name' => 'Leistung',
					'id' => 'Leistung',
					'maxlength' => '1000',
					'value' => $vdata['Leistung'],
				),
			),
			'TeilnehmerBeitrag' => array(
				'htmltype' => 'text',
				'name' => 'Teilnehmer Beitrag:',
				'html' => array(
					'name' => 'TeilnehmerBeitrag',
					'id' => 'TeilnehmerBeitrag',
					'maxlength' => '10',
					'value' => $vdata['Besonderheiten'],
				),
			),
			'Besonderheiten' => array(
				'htmltype' => 'textarea',
				'name' => 'Besonderheiten:',
				'html' => array(
					'name' => 'Besonderheiten',
					'id' => 'Besonderheiten',
					'maxlength' => '1000', 		//Zeichenanzahl
					'rows' => '8', 			// Zeilen
					'cols' => '50', 			// Spalten
					'value' => $vdata['Besonderheiten'],
				),
			),

		);

?>

<script type="text/javascript">
function chkFormular () {
  if (document.Formular.Name.value == "") {
    alert("Bitte Namen der Veranstaltung angeben!");
    document.Formular.Name.focus();
    return false;
  }
  if (document.Formular.Traeger.value == "") {
    alert("Bitte Träger angeben!");
    document.Formular.Traeger.focus();
    return false;
  }
}
</script>

<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";
echo $VeranstaltungID;
echo validation_errors();
 
$attributs = array('name' => 'Formular', 'onsubmit' => 'return chkFormular()');

//echo form_open('main/datenErfolg',$attributs);
//echo form_open('main/formularVeranstaltung');
echo form_open();
?>

<!-- <form method="post" action="<?php echo ""; ?>"> -->
<div class="eingabe">


<?php echo form_fieldset('Veranstaltungs Daten'); 
$this->load->library('table');

foreach ($veranstaltungform as $element) {

	
		$name = "";
		$value = "";
// 	  	echo '<div class="input">';
// 		echo "\n\t\t\t\t";
		$name = form_label($element['name'],$element['html']['id']);
// 		echo "\n\t\t\t\t";

	switch ($element['htmltype']) {	  
	    case 'text':
	        $value =  form_input($element['html']);
	        break;
		case 'textarea':
			$value =  form_textarea($element['html']);
	        break;
	    case 'function':
	        $value =  $element['funcname']($element);
	        break;
		case 'checkbox':

	        $value =  form_checkbox($element['html'],$element['html']['id'],$element['html']['checked']);
	        break;	
		case 'dropdown':

	        $value =  form_dropdown($element['html']['id'],$element['values'],$element['selected']);
	        break;	
	}
	
	$this->table->add_row($name, $value);
// 	echo "\n\t\t\t\t";
// 	echo "</div>\n\t\t\t\t";	
	

}
//Tabelle generieren lassen
echo $this->table->generate();

echo form_fieldset_close(); ?>


</div>
	<p>
		<?php echo form_submit('Speichern','Speichern'); ?>
	</p>
</form>
		

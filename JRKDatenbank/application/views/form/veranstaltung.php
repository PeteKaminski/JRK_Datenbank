<h3>Hinzuf&uuml;gen einer Veranstaltung.</h3>

<?php 
//echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');
	
	$vdata['Name'] = set_value('Name');
	
	
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
					'value' => 'Senat',
				)
			),
			'Thema'=>array(
				'htmltype' => 'text',
				'name' => 'Thema:',
				'html' => array(
					'name' => 'Thema',			//Name von oben
					'id' => 'Thema',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
				)
			),
			'ArtMassnahme' => array(
				'htmltype' => 'dropdown',
				'name' => 'Name:',
				'html' => array(
					'name' => 'Art der Massnahme:',
					'id' => 'ArtMassnahme',
				),
				'values' => array(
					'1' => 'Kurs',
					'2' => 'Internationale Begegnung',
					'3' => 'Ferienmassnahme',
				),
				'selected' => '1',
			),
			'Strasse' => array(
				'htmltype' => 'text',
				'name' => 'Stasse:',
				'html' => array(
					'name' => 'Strasse',
					'id' => 'Strasse',
					'maxlength' => '100',
				)
			),
			'HausNr' => array(
				'htmltype' => 'text',
				'name' => 'Hausnummer:',
				'html' => array(
					'name' => 'HausNr',
					'id' => 'HausNr',
					'maxlength' => '100',
				)
			),
			'Plz' => array(
				'htmltype' => 'text',
				'name' => 'PLZ:',
				'html' => array(
					'name' => 'PLZ',
					'id' => 'Plz',
					'maxlength' => '100',
				)
			),
			'Ort' => array(
				'htmltype' => 'text',
				'name' => 'Ort:',
				'html' => array(
					'name' => 'Ort',
					'id' => 'Ort',
					'maxlength' => '100',
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
					'tag' => '1',				//voreingestellter Tag
					'monat' => '1',				//voreingestellter monat
					'jahr' => '2000',			//voreingestellter jahr
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
					'tag' => '1',				//voreingestellter Tag
					'monat' => '1',				//voreingestellter monat
					'jahr' => '2000',			//voreingestellter jahr
				),
			),
			'MaxTeilnehmer' => array(
				'htmltype' => 'text',
				'name' => 'Maximale Teilnehmer:',
				'html' => array(
					'name' => 'MaxTeilnehmer',
					'id' => 'MaxTeilnehmer',
					'maxlength' => '100',
				),
			),
			'Leistung' => array(
				'htmltype' => 'text',
				'name' => 'Leistung:',
				'html' => array(
					'name' => 'Leistung',
					'id' => 'Leistung',
					'maxlength' => '1000',
				),
			),
			'TeilnehmerBeitrag' => array(
				'htmltype' => 'text',
				'name' => 'Teilnehmer Beitrag:',
				'html' => array(
					'name' => 'TeilnehmerBeitrag',
					'id' => 'TeilnehmerBeitrag',
					'maxlength' => '10',
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
					'cols' => '50'  			// Spalten
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
  
foreach ($veranstaltungform as $element) {

	  	echo '<div class="input">';
		echo "\n\t\t\t\t";
		echo form_label($element['name'],$element['html']['id']);
		echo "\n\t\t\t\t";

	switch ($element['htmltype']) {	  
	    case 'text':
	        echo form_input($element['html']);
	        break;
		case 'textarea':
			echo form_textarea($element['html']);
	        break;
	    case 'function':
	        $element['funcname']($element);
	        break;
		case 'checkbox':

	        echo form_checkbox($element['html'],$element['html']['id'],$element['html']['checked']);
	        break;	
		case 'dropdown':

	        echo form_dropdown($element['html']['id'],$element['values'],$element['selected']);
	        break;	
	}
	
	echo "\n\t\t\t\t";
	echo "</div>\n\t\t\t\t";	
}


echo form_fieldset_close(); ?>


</div>
	<p>
		<?php echo form_submit('speichern','Speichern'); ?>
	</p>
</form>
		

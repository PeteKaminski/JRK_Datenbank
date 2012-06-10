<h3>Hinzuf&uuml;gen einer Veranstaltung.</h3>

<?php 
echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');

echo form_open();
	
	$veranstaltungform = array(
			'Name'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Name:',			//Name von oben
					'id' => 'Name',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
				)
			),
			'Traeger'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Traeger:',			//Name von oben
					'id' => 'Traeger',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
				)
			),
			'Thema'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Thema:',			//Name von oben
					'id' => 'Thema',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
				)
			),
			'Art'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Art:',			//Name von oben
					'id' => 'Art',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
				)
			),
			'DatumBegin' => array(
				'htmltype' => 'function',
				'funcname' => 'DayValue',
				'html' => array(
					'name' => 'DatumBegin:',	//Anzeige Beschreibungsname 
					'id' => 'DatumBegin',		//wie name nur kleingeschrieben
				),
				'parameter' =>array(
					'name' => 'DatumBegin',		//Wie Oben
					'tag' => '1',				//voreingestellter Tag
					'monat' => '1',				//voreingestellter monat
					'jahr' => '2000',			//voreingestellter jahr
				),
			),		
			'Besonderheiten' => array(
				'htmltype' => 'textarea',
				'html' => array(
					'name' => 'Besonderheiten:',
					'id' => 'Besonderheiten',
					'maxlength' => '1000', 		//Zeichenanzahl
					'rows' => '20', 			// Zeilen
					'cols' => '50'  			// Spalten
			)
		)
		);

?>



<form method="post" action="<?php echo ""; ?>">
<div class="eingabe">

<?php echo form_fieldset('Veranstaltungs Daten'); 
  
foreach ($veranstaltungform as $element) {

	  	echo '<div class="input">';
		echo "\n\t\t\t\t";
		echo form_label($element['html']['name'],$element['html']['id']);
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
		

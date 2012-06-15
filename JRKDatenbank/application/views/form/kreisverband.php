<h3>Hinzuf&uuml;gen eines kreisverbandes.</h3>

<?php 
echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');
$this->load->library('table');
echo form_open();
	
	$kreisverbandform = array(
			'Name'=>array(
				'htmltype' => 'text',
				'html' => array(
					'name' => 'Name:',			//Name von oben
					'id' => 'Name',				//Wie Name	
					'maxlength' => '100',		//Zeichenanzahl
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
			
		);

?>



<form method="post" action="<?php echo ""; ?>">
<div class="eingabe">

<?php echo form_fieldset('Kreisberband Daten'); 

$this->table->set_heading('', '');

foreach ($kreisverbandform as $element) {
	
	$name = "";
	$value = "";
//   	echo '<div class="input">';
// 	echo "\n\t\t\t\t";
	$name =  form_label($element['html']['name'],$element['html']['id']);
// 	echo "\n\t\t\t\t";

	switch ($element['htmltype']) {	  
	    case 'text':
	        $value =  form_input($element['html']);
	        break;
		case 'textarea':
			$value =  form_textarea($element['html']);
	        break;
	    case 'function':
	        $value = $element['funcname']($element);
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
echo $this->table->generate();


echo form_fieldset_close(); ?>


</div>
	<p>
		<?php echo form_submit('speichern','Speichern'); ?>
	</p>
</form>
		

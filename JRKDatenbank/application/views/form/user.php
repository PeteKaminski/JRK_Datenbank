<h3>Hinzuf&uuml;gen eines Mitgliedes.</h3>

<?php 
echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');
$this->load->library('table');

echo form_open('main/formularUser')

?>

<!-- <form method="post" action="<?php echo ""; ?>"> -->
<div class="eingabe">

<?php echo form_fieldset('Pers&ouml;nliche Daten'); 

$this->table->set_heading('', '');
foreach ($userform as $element) {

		$name = "";
		$value = "";
// 	  	echo '<div class="input">';
// 		echo "\n\t\t\t\t";
		$name =  form_label($element['html']['name'],$element['html']['id']);
// 		echo "\n\t\t\t\t";

	switch ($element['htmltype']) {	  
	    case 'text':
	        $value = form_input($element['html']);
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
		<?php echo form_submit('speichern','Speichern'); ?>
	</p>
</form>
		

<h3>Hinzuf&uuml;gen eines Mitgliedes.</h3>

<?php 
echo validation_errors(); 
$this->load->helper('form');
$this->load->helper('MY_user_helper');

echo form_open()

?>

<form method="post" action="<?php echo ""; ?>">
<div class="eingabe">

<?php echo form_fieldset('Pers&ouml;nliche Daten'); 
  
foreach ($userform as $element) {

	  	echo '<div class="input">';
		echo "\n\t\t\t\t";
		echo form_label($element['html']['name'],$element['html']['id']);
		echo "\n\t\t\t\t";

	switch ($element['mytype']) {	  
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
		

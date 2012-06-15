<?php

//$data = $this->User_model->deleteUser(2);
echo "testDB";
$this->User_model->addUser(array('Vorname' => 'dennis','Name' => 'asd'));
//$data  = $this->Vera_model->getVeranstaltung(1); 

if (isset($data)) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
?>
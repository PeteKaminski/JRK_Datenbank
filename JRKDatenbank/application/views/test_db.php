<?php

//$data = $this->User_model->deleteUser(2);
//$this->Dbuser_model->addUser('dennis','asd',1);
$data  = $this->Dbuser_model->changePW('dennis', 'asd', 'dsa'); 

if (isset($data)) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
?>
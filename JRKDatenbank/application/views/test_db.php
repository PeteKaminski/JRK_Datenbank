<?php

//$data = $this->User_model->deleteUser(2);
$data  = $this->login_model->check_user('dennis','asd');

if (isset($data)) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
?>
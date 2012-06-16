<?php

//$data = $this->User_model->deleteUser(2);
echo "<h1>testDB</h1>";
//$this->User_model->addUser(array('Vorname' => 'dennis','Name' => 'asd'));
$data  = $this->Kreis_model->updateKreisverband('new',array('Abkuerzung' => 'Gstars','Ortsteil' => 'teil', 'Kreisjugendleiter' => '1', 'Kreisjugendleiter2' => '9', 'Ort' => 'Berlin', 'Strasse' => 'Strr.', 'Hausnr' => '22', 'Plz' => '12345'));

if (isset($data)) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
?>
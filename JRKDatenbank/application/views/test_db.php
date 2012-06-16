<?php

//$data = $this->User_model->deleteUser(2);
echo "<h1>testDB</h1>";
//$this->User_model->addUser(array('Vorname' => 'dennis','Name' => 'asd'));
$data  = $this->Vera_model->updateVeranstaltung(1,array('Thema' => 1, 'Art' => 'Ausflug', 'Name' => 'Heidepark', 'Ort' => 'Soltau',
 'Strasse' => 'Heidestr. 1', 'Plz' => 20033, 'Hausnr' => 21, 'DatumBegin' => '2005-05-13 07:15:31', 'DatumEnde' => '2005-05-14 07:15:31',
  'MaxTeilnehmer' => 10, 'Leistung' => 'Lehrninhalte', 'TnBeitrag' => 12.3)); 

if (isset($data)) {

	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
?>
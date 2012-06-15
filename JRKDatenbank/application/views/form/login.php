<h1>Anmeldung in die JRK Datenbank.</h1>

<?php	// Hier entsteht das Formular zum einloggen in die Mitgliederverwaltung
	   	// Eine Sessin ID wird danach generiert um damit weiter Arbeiten zu können.
$this->load->helper('form');

echo form_open('main/index/main');
echo "Testlogin mit</br> User: test</br>";
echo "Passwort: test";
echo form_input('username', 'User');
echo form_password('username_pw', '');
echo form_submit('login', 'Login');

?>


<?php


if ( ! isset($_POST['Formular']))
 {
     echo 'ist gesetzt';
 }
 else
 {
     echo 'nicht gesetzt';
 }

echo "<pre>";
print_r($_POST);
echo "</pre>";

ergolgreich($_POST['Name'],'main/formularVeranstaltung');

?>

<?php
function ergolgreich($name, $weiterleitung)
{
	
echo "<h3>Daten der Veranstaltung <b>".$name."</b> erfoglgreich eingetragen!</h3>";
echo anchor($weiterleitung, 'Neue Veranstaltung eintragen.');

}
?>
<html>
<head>
<title>My Form</title>
</head>
<body>

<h3>Your form was successfully submitted!</h3>

<p><?php 

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

echo anchor('form', 'Try it again!'); ?></p>

</body>
</html>


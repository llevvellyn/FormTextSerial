<html>
<head>
<title>A BASIC HTML FORM</title>
</head>

<body>

The following data will be sent to serial:

<FORM NAME ="" METHOD ="POST" ACTION = "index.php">

<INPUT TYPE = "TEXT" VALUE ="message" NAME = "message">
<INPUT TYPE = "submit" Name = "submit" VALUE = "Submit">

</FORM>

<?php

$message = $_POST['message'];

$filename = "share.txt";
$f = fopen($filename, "w");
fprintf($f, $message);
fclose ($f);

?>


</body>

</html>

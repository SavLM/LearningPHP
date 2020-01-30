<?php
	$model = trim($_POST["model"]);
	$transmission = trim($_POST["transmission"]);
	$color = trim($_POST["color"]);
	$index = trim($_POST["index"]);

	$servername = "localhost";
	$username = "allie";
	$password = "hello"; // so secure
	$connection = mysqli_connect($servername, $username, $password);
	// check connection
	if (!$connection){
	  echo("Connection failed: " . mysqli_connect_error());
	}

	$db = new mysqli($servername, $username, $password, 'allie');
	if ($db->connect_error):
	 die ("Could not connect to db " . $db->connect_error);
	endif;

	$query = "delete from Cars where Cars.id =$index";
	echo $query;
	$db->query($query) or die ("Invalid: " . $db->error);

	$query = "insert into Cars values (NULL, '$model', '$transmission', '$color')";
	echo $query;
	$db->query($query) or die ("Invalid: " . $db->error);
?>

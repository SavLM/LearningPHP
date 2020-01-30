<?php

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

	$result = $db->query("select * from Cars") or die ("Invalid: " . $db->error);
	$rows = $result->num_rows;
	$arr = Array();
	for ($i = 0; $i < $rows; $i++) {
		array_push($arr, $result->fetch_array());
	}
	$returndata = json_encode($arr);
	echo $returndata;
?>

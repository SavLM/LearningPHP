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

$db->query("drop table Cars");

$result = $db->query("create table Cars (id int primary key not null auto_increment, type varchar(30), transmission varchar(30), color varchar(30))") or die ("Invalid: " . $db->error);

$xml=simplexml_load_file("data.xml") or die("Error: Cannot create object");
$json = json_encode($xml);
$array = json_decode($json,TRUE);
foreach ($array["car"] as $carobj) {
    $type = trim($carobj["type"]);
    $transmission = trim($carobj["transmission"]);
    $color = trim($carobj["color"]);
    $query = "insert into Cars values (NULL, '$type', '$transmission', '$color')";
    $db->query($query) or die ("Invalid insert " . $db->error);

}
echo "Successfully initialized!"
?>

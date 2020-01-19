<?php

$servername = "localhost";
$username = "savannah";
$password = "savannah"; // so secure
$connection = mysqli_connect($servername, $username, $password);
// check connection
if (!$connection):
echo("Connection failed: " . mysqli_connect_error());
endif;

$db = new mysqli($servername, $username, $password, 'cookbook');
if ($db->connect_error):
die ("Could not connect to db " . $db->connect_error);
endif;

  // get all of the menu names
   $query = "select name from menus";
   $result = $db->query($query);
   $rows = $result->num_rows;
   if ($rows >= 1):
      header('Content-type: text/xml');
      echo "<?xml version='1.0' encoding='utf-8'?>";
      echo "<Menu>";
      $ans = "";
      while($row = mysqli_fetch_array($result)) {
        $ans .= $row["name"]."#";
      }
      echo "<value>$ans</value>";
      echo "</Menu>";
   else:
      die ("DB Error");
   endif;
?>

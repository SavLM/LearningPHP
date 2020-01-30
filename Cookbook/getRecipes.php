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

// get menu name
if( $_REQUEST["menu_name"] ):
   $menu_name = $_REQUEST["menu_name"];

   // get menu id
   $query = "select id from menus where name = '$menu_name'";
   $result = $db->query($query);
   $rows = $result->num_rows;
   $menu_id = "";
   if ($rows >= 1):
     while($row = mysqli_fetch_array($result)) {
       $menu_id = $row["id"];
     }
   endif;
   // get recipe ids from menu id
   $query = "select recipe_id from mrrelationship where menu_id = '$menu_id'";
   $result = $db->query($query);
   $rows = $result->num_rows;
   $recipe_ids="";
   if ($rows >= 1):
     while($row = mysqli_fetch_array($result)) {
       $recipe_ids .= $row["recipe_id"]."#";
     }
   endif;

   // get recipe titles
   $recipe_id_array = explode("#", $recipe_ids);
   $recipe_titles="";
   foreach($recipe_id_array as $recipe_id_obj){
     $query = "select title,rating from recipes where id = '$recipe_id_obj'";
     $result = $db->query($query);
     $rows = $result->num_rows;
     if ($rows >= 1):
       while($row = mysqli_fetch_array($result)) {
         $recipe_titles .= $row["title"]."+".$row["rating"]."#";
       }
     endif;
   }
   header('Content-type: text/xml');
   echo "<?xml version='1.0' encoding='utf-8'?>";
   echo "<Recipe>";
   echo "<value>$recipe_titles</value>";
   echo "</Recipe>";
 endif;
?>

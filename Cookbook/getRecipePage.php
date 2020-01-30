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

// get recipe title
if( $_REQUEST["recipe_title"] ):
   $recipe_title = $_REQUEST["recipe_title"];

   // get recipe info to display
   $query = "select * from recipes where title = '$recipe_title'";
   $result = $db->query($query);
   $rows = $result->num_rows;
   $recipe_rating = "";
   $recipe_directions = "";
   $recipe_ingredients = "";
   if ($rows >= 1):
     header('Content-type: text/xml');
     echo "<?xml version='1.0' encoding='utf-8'?>";
     echo "<RecipeInfo>";
     while($row = mysqli_fetch_array($result)) {
       $recipe_rating = $row["rating"];
       $recipe_directions = $row["directions"];
       $recipe_ingredients = $row["ingredients"];
     }
     $ret = $recipe_title."+".$recipe_rating."+".$recipe_directions."+".$recipe_ingredients;
     echo "<value>$ret</value>";
     echo "</RecipeInfo>";
  else:
     die ("DB Error");
  endif;
endif;
   ?>

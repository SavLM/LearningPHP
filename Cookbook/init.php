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

   // create tables
   // menus/categories
   $db->query("drop table menus");
   $result = $db->query("create table menus(id int primary key not null auto_increment, name varchar(30))") or die ("Creating menu table: Invalid: " . $db->error);
   // recipes
   $db->query("drop table recipes");
   $result = $db->query("create table recipes(id int primary key not null auto_increment, title varchar(30), rating int, directions varchar(60), ingredients varchar(60))") or die ("Creating recipe table: Invalid: " . $db->error);
   // create many-to-many relationship between menus and recipes
   $db->query("drop table mrrelationship");
   $result = $db->query("create table mrrelationship(menu_id int , recipe_id int)") or die ("Creating mrrelationship table: Invalid: " . $db->error);

   $xml=simplexml_load_file("cookbook.xml") or die("Error: Cannot create object");

   foreach($xml as $cbobj):
     $menu_name = $cbobj['name'];

     $query = "insert into menus values (NULL, '$menu_name')";
     $db->query($query) or die ("Invalid insert " . $db->error);

     $query = "select * from menus where menus.name = '$menu_name'";
     $result = $db->query($query) or die ("menu not found");
     $menu_id_result = $result->fetch_array();
     $menu_id = stripslashes($menu_id_result["id"]);

     $recipe = $cbobj->recipe;
     foreach($recipe as $recipeobj):
       $title = $recipeobj->title;
       $rating = $recipeobj->rating;
       $directions = $recipeobj->directions;
       $ingredients =  $recipeobj->ingredients;
       
       $query = "insert into recipes values (NULL, '$title', '$rating', '$directions', '$ingredients')";
       $db->query($query) or die ("Invalid insert " . $db->error);

       $query = "select * from recipes where recipes.title = '$title'";
       $result = $db->query($query) or die ("recipe not found");
       $recipe_id_result = $result->fetch_array();
       $recipe_id = stripslashes($recipe_id_result["id"]);

       $query = "insert into mrrelationship values ('$menu_id','$recipe_id')";
       $db->query($query) or die ("Invalid insert " . $db->error);

     endforeach;
   endforeach;
   echo "Successfully initialized!"

?>
<html>
   <head>
   </head>
   <body>
   </body>
</html>

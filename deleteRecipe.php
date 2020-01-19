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

   $recipe_title ="";
   $menu_name ="";

   // get the menu name
   if( $_REQUEST["m_name"] ):
      $menu_name = $_REQUEST["m_name"];
   endif;
   // get the recipe title
   if( $_REQUEST["r_title"] ):
      $recipe_title = $_REQUEST["r_title"];
   endif;

   // get the recipe id
   $query = "select * from recipes where recipes.title = '$recipe_title'";
   $result = $db->query($query) or die ("recipe not found");
   $recipe_id_result = $result->fetch_array();
   $recipe_id = stripslashes($recipe_id_result["id"]);

   // get the menu id
   $query = "select * from menus where menus.name = '$menu_name'";
   $result = $db->query($query) or die ("menu not found");
   $menu_id_result = $result->fetch_array();
   $menu_id = stripslashes($menu_id_result["id"]);

   // delete the relationship between the recipe and menu
   $query = "delete from mrrelationship where mrrelationship.menu_id ='$menu_id' and  mrrelationship.recipe_id ='$recipe_id'";
   $db->query($query) or die ("Invalid delete " . $db->error);

?>

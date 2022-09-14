<?php
  session_start();
  require("./navbar.php");
?>
<!DOCTYPE html>

<html>
  	<head>
		<meta charset="UTF-8" />
		<title>Menu</title>
		<link rel="stylesheet" href="/style.css" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
		<div id="output_message"></div>
		<nav>
			<ul id="navbar">
				<?php 
				if(isset($_SESSION["role"])){
					getRoleNav($_SESSION["role"]);
				} 
				else {
					getRoleNav();
				} 
				?>
			</ul>
		</nav>
		<script src="message_script.js"></script>  
  </body>
</html>


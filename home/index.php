<?php
  session_start();
  require("../navbar.php");
  require("../footer.php");
  require("./post.php");
?>
<!DOCTYPE html>

<html>
  	<head>
		<meta charset="UTF-8" />
		<title>Menu</title>
		<link rel="stylesheet" href="/style.css" />
		<link rel="stylesheet" href="./style.css">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">    
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
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

		<div id="blog_entry_container">
			<?php 
				post_blog_entries();
			?>
		</div>


		<div class="footer">
			<div class="text">
				<?php
					footer();
				?>
			</div>
		</div>
		<script src="../message_script.js"></script>  
  </body>
</html>
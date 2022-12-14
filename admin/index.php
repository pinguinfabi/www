<?php
	session_start();
	require_once("../logincheck.php");
	loginCheck();
	checkAdminRole();
	require("../navbar.php");
	require("../footer.php");
	require("./users.php");
	require("./user_posts.php");
	require_once("../config.php");

	if(isset($_GET["id"])){
		$id = $_GET["id"];

		$conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
		if(mysqli_connect_errno()){
			header("Location: ../home/index.php?e=dberr");
			exit();
		}

		$stmt = $conn->prepare("SELECT username, email, created_at, updated_at, role FROM users WHERE id = ?");
    	$stmt->bind_param("i",$id);
   	 	$stmt->execute();
    	$stmt->store_result();
		$stmt->bind_result($username, $email, $created_at, $updated_at, $role);
		$stmt->fetch();
	}

?>
<!DOCTYPE html>

<html>
  	<head>
		<meta charset="UTF-8" />
		<title>Admin</title>
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
		
		<div class="container" id="main_container">
			<div class="left_sidebar">
				<div class="user_list">
					<?php 
						post_users();
					?>
				</div>
				<div class="user_create">
					<div id="user_creation_button"><i class="fa-solid fa-user-plus"></i></div>
				</div>
			</div>
			<div class="user_details" id="user_details_container">
				<div class="user_name"><?php if(isset($username)) echo $username; ?> <?php if(isset($id)) echo "(".$id.")" ; ?></div>
				<div class="user_dates"> 
					<div class="user_dates-text"> 
						<div class="user_dates-text1"><?php if(isset($created_at)) echo date("d/m/Y", strtotime($created_at)); ?> </div><br> 
						<div class="user_dates-text2"><?php if(isset($updated_at)) echo date("d/m/Y", strtotime($updated_at)); ?></div>
					</div>
				</div>
				<div class="user_other-info"> <?php if(isset($role)) echo $role; ?><br></div>
				<div class="user_mail"> <div class="user_mail-text"> <?php if(isset($email)) echo $email; ?> </div></div>
			</div>
			<?php 
				if (!isset($_GET["id"])) {
					echo "<script>";
					echo "document.getElementById('user_details_container').innerHTML = null;";
					echo "document.getElementById('user_details_container').classList.remove('user_details');";
					echo "document.getElementById('user_details_container').classList.add('choose_user_note');";
					echo "document.getElementById('user_details_container').innerHTML = '<h1><i class=\"fa-solid fa-arrow-left-long\"></i><br><br>Choose a user!</h1>';";
					echo "</script>";
					echo "<style>";
					echo ".user_actions { filter: contrast(0.25); }";
					echo ".user_actions * { cursor: not-allowed !important; }";
					echo ".user_posts { filter: contrast(0.25); }";
					echo ".user_posts, .user_posts * { cursor: not-allowed !important; }";
					echo "</style>";
				}
			?>
			<div class="user_posts">
				<table>
					<thead>
						<tr>
							<th>Id</th>
							<th>Titel</th>
							<th>Datum</th>
							<th>Author</th>
							<th>Sichtbarkeit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($_GET["id"])) {
								post_posts($id);
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="user_actions">
				<div class="user_action-purge">
					<div class="user_actions-action_icon"><i class="fa-solid fa-gavel"></i></div>
					<div class="user_actions-action_title">Bann</div>
				</div>
				<div class="user_action-role">
					<div class="user_actions-action_icon"><i class="fa-solid fa-scale-unbalanced-flip"></i></div>
					<div class="user_actions-action_title">Rolle</div>
				</div>
				<div class="user_action-invis_all">
					<div class="user_actions-action_icon"><i class="fa-solid fa-eye-slash"></i></div>
					<div class="user_actions-action_title">Sichtbarkeit</div>
				</div>
				<div class="user_action-verify">
					<div class="user_actions-action_icon"><i class="fa-solid fa-certificate"></i></div>
					<div class="user_actions-action_title">Verifikation</div>
				</div>
			</div>
		</div>

		<div class="footer" id="footer_container">
			<div class="text">
				<?php
					footer();
				?>
			</div>
		</div>
		<script src="../message_script.js"></script> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="./script.js"></script> 
  </body>
</html>






<!-- <i class="fa-solid fa-circle-check"></i> -->
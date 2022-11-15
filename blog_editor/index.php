<?php 
    session_start();
    require_once("../logincheck.php");
    loginCheck();
    checkAuthorRole();
    require("../navbar.php");
    require_once("../config.php");
    require("../footer.php");
    $id = $_GET["id"];
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ../index.php?e=dberr");
        exit();
    }

    // Get author name
    $stmt = $conn->prepare("SELECT author FROM `blog` WHERE article_id = ?");
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($author);
    $stmt->fetch();

    // Checks if username and author name is the same
    if (strtolower($_SESSION["username"]) != strtolower($author) && $_SESSION["role"] != "admin") {
        header("Location: ../?e=norights");
        $stmt->close();
    } else {
        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT title FROM blog WHERE article_id = ?");
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($title);
    $stmt->fetch();
    $stmt->close();


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="editor.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post bearbeiten</title>
</head>
<body>
    <div id="output_message"></div>

    <p id="hidden_id" style="display:none;"><?=$_GET["id"]?></p>
    
    <nav>
        <ul id="navbar">
            <?php getRoleNav($_SESSION['role']) ?>
        </ul>
    </nav>

    <textarea id="title" name="title" id="title" cols="50" rows="1"><?=$title?></textarea>

    <div id="editorjs"></div>



    <div id="button_group">
        <button id="button_delete">Delete</button><button id="button_save">Save</button><button id="button_publish">Publish</button>
    </div>
    <script src="../message_script.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@v2.25.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.browser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-paragraph-with-alignment@3.0.0"></script>


    <div class="footer">
		<div class="text">
			<?php
				footer();
			?>
		</div>
	</div>

    <script src="./index.js"></script>
   

</body>
</html>
<?php 
    session_start();
    // require_once("../logincheck.php");
    // loginCheck();
    // checkAuthorRole();
    require("../navbar.php");
    require_once("../config.php");
    $id = $_GET["id"];
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ../index.php?e=dberr");
        exit();
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
    <p id="hidden_id" style="display:none;"><?=$_GET["id"]?></p>
    
    <nav>
        <ul id="navbar">
            <?php getRoleNav($_SESSION['role']) ?>
        </ul>
    </nav>

    <textarea id="title" name="title" id="title" cols="50" rows="1"><?=$title?></textarea>

    <div id="editorjs"></div>



    <div id="button_group">
    <button>Cancle</button><button id="button_save">Save</button><button>Publish</button>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@v2.25.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@3.4.0/build/edjsHTML.browser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="./index.js"></script>

</body>
</html>
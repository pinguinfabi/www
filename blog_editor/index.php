<?php 
    session_start();
    require_once("../loginchek.php");
    loginCheck();
    checkAuthorRole();
    require("../navbar.php");

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post bearbeiten</title>
</head>
<body>
    
    <nav>
        <ul id="navbar">
            <?php getRoleNav($_SESSION['role']) ?>
        </ul>
    </nav>


    <div id="editor"> </div>




    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@v2.25.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script> 
        const editor = new EditorJS({
            // Div containing editor
            holder: 'editor',
            // Other configuration properties
            tools: {
                header: Header,
            },
            /**
            * onReady callback
            */
            onReady: () => {
                console.log('Editor.js is ready to work!')
            }
        });
</script>
</body>
</html>
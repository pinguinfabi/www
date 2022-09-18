<?php 

    $id = $_GET["id"];

    $f = fopen("./blog_entry_html_".$id.".json", "r");
    $readFile = json_decode(fread($f, filesize("./blog_entry_html_".$_GET["id"].".json")));
    fclose($f);

    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit;
    }
    
    $stmt = $conn->prepare("SELECT title FROM blog WHERE article_id = ?");
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($title);
    $stmt->fetch();

?>


<!DOCTYPE html>
<html lang="de-DE">
<head>
    <link rel="stylesheet" href="/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
</head>
<body>
    
    <?php 
        foreach ($readFile as $val) {
            echo $val;
        }
    ?>
</body>
</html>
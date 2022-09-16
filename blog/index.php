<?php 
    require_once("./blog_entry_".$_GET["id"].".php");
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
        foreach (json_decode($html) as $key => $value) {
            echo $value;
        }
    ?>
</body>
</html>
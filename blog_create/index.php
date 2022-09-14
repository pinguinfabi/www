<?php 
    session_start();
    require_once("../loginchek.php");
    loginCheck();
    checkAuthorRole();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ../index.php?e=dberr");
        exit();
    }

    

?>

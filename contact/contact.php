<?php
    session_start();
    require_once("../logincheck.php");
    loginCheck();
    checkAuthorRole();
    require("../navbar.php");
    require_once("../config.php");
    require("../footer.php");
    $emailuser = $_POST['email'];
    $username_form = $_SESSION['username'];
    $betreff = $_POST['Betreff'];
    $message = $_POST['text'];
    $id = $_SESSION['id'];
    $username_admin = "username=".$username_form.";id=".$id;
    $betreff = "Betreff:".$betreff.";".$username_admin;
    $email = "fabiderpinguin@gmail.com";

    mail($email, $betreff, $message);


    //     echo($username_admin);
 
?>

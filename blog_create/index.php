<?php 
    session_start();
    require_once("../logincheck.php");
    loginCheck();
    checkAuthorRole();
    require_once("../config.php");
    $userid = $_SESSION['id'];
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ../index.php?e=dberr");
        exit();
    }
    // sets username to right user id
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i",$userid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
    // insert an example blog page
    $stmt = $conn->prepare("INSERT INTO blog (title,author,visibility) VALUES (?,?,?)");
    $stmt->bind_param("sss","Titel",$username,"0");
    $stmt->execute();
    $conn->close();
    header("Location: ../blog_editor/");
    exit();
?>

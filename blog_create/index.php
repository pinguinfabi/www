<?php 
    session_start();
    require_once("../logincheck.php");
    loginCheck();
    checkAuthorRole();
    require_once("../config.php");
    $userid = $_SESSION['id'];
    $zero = 0;
    $title = "Titel";
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
    $stmt = $conn->prepare("INSERT INTO blog (title, author, visibility) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi",$title,$username,$zero);
    $stmt->execute();
    $blogid = $stmt->insert_id;
    $conn->close();
    $filepath = "../blog/blog_entry_".$blogid.".php";
    $file = fopen($filepath, "w");
    fclose($file);
    header("Location: ../blog_editor/?id=".$blogid);
    exit();
?>

<?php 

    $id = $_POST['id'];

    session_start();
    require_once("../logincheck.php");
    loginCheck();
    checkAuthorRole();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit("DB ERROR");
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
        exit("norights");
        $stmt->close();
    } else {
        $stmt->close();
    }

    // Deletes DB row
    $stmt = $conn->prepare("DELETE FROM `blog` WHERE article_id = ?");
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $stmt->close();

    // Deletes html file
    $filepath_html = "../blog/blog_entry_html_".$id.".json";

    $status=unlink($filepath_html);

    // Deletes json file
    $filepath_json = "../blog/blog_entry_json_".$id.".json";

    $status=unlink($filepath_json);

    if($status){

        exit("SUCCESS"); 
        
    }else{

        exit("DEL_FAIL");
    }
   
?>
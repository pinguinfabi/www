<?php 
    $json = $_POST['json'];
    $html = $_POST['html'];
    $title = $_POST['title'];
    $id = $_POST['id'];

    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit;
    }

    $stmt = $conn->prepare("UPDATE blog SET title = ? WHERE article_id = ?");
    $stmt->bind_param("ss",$title,$id);
    $stmt->execute();
    $stmt->close();

    $filepath_html = "../blog/blog_entry_html_".$id.".json";
    file_put_contents($filepath_html, $html);

    $filepath_json = "../blog/blog_entry_json_".$id.".json";
    file_put_contents($filepath_json, $json);
?>
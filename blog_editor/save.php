<?php 
    $json = $_POST['json'];
    $html = $_POST['html'];
    $title = $_POST['title'];
    $id = $_POST['id'];

    $examplejson = '{"time":1663706211431,"blocks":[{"id":"5ZFH1QP8hR","type":"paragraph","data":{"text":"No Text was saved...","alignment":"left"}}],"version":"2.25.0"}';
    $examplehtml = '["<p>No Text was saved...</p>"]';

    $emptyjson =  '{"time":1663705284652,"blocks":[],"version":"2.25.0"}';
    $emptyhtml = "[]";

    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit;
    }

    // updates blog title
    $stmt = $conn->prepare("UPDATE blog SET title = ? WHERE article_id = ?");
    $stmt->bind_param("ss",$title,$id);
    $stmt->execute();
    $stmt->close();

    // Checks if smth was written in the editor
    if (strlen($json) == strlen($emptyjson) ) {
        $json = $examplejson;
    };

    if ($html == $emptyhtml ) {
        $html = $examplehtml;
    };

    // Writs in the file
    $filepath_html = "../blog/blog_entry_html_".$id.".json";
    file_put_contents($filepath_html, $html);

    $filepath_json = "../blog/blog_entry_json_".$id.".json";
    file_put_contents($filepath_json, $json);
?>
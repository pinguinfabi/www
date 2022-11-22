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
    $stmt = $conn->prepare("INSERT INTO blog (title, author, author_id, visibility) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii",$title,$username, $userid, $zero);
    $stmt->execute();
    $blogid = $stmt->insert_id;
    $conn->close();
    $filepath = "../blog/blog_entry_html_".$blogid.".json";
    $file = fopen($filepath, "w");
    fwrite($file, '["<p>Write your text here...</p>"]');
    fclose($file);
    $filepath = "../blog/blog_entry_json_".$blogid.".json";
    $file = fopen($filepath, "w");
    fwrite($file, '{"time":1663703565808,"blocks":[{"id":"vuL8va1eFj","type":"paragraph","data":{"text":"Write your text here...","alignment":"left"}}],"version":"2.25.0"}');
    fclose($file);
    header("Location: ../blog_editor/?id=".$blogid);
    exit();
?>

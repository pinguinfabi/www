<?php 
session_start();
require_once("../config.php");
$conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
if(mysqli_connect_errno()){
    header("Location: ./login.php?e=dberr");
    exit();
}


function post_posts($id){
    global $conn;
    // Get all users
    $blog_list = array();
    $query=$conn->query("SELECT article_id, title, created_at, author, visibility FROM `blog` WHERE author_id = $id ORDER BY created_at ASC LIMIT 5;");
    if($query){
        while($row = mysqli_fetch_array($query)){
            echo '<tr>';
            echo '<td>'.$row["article_id"].'</td>';
            echo '<td>'.$row["title"].'</td>';
            echo '<td>'.$row["created_at"].'</td>';
            echo '<td>'.$row["author"].'</td>';
            echo '<td>'.$row["visibility"].'</td>';
            echo '</tr>';
        }
    }
}




?>
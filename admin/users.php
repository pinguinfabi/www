<?php 
    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit();
    }
    

    function post_users(){
        global $conn;
        // Get all users
        $blog_list = array();
        $query=$conn->query("SELECT username FROM `users` ORDER BY created_at ASC;");
        if($query){
            while($row = mysqli_fetch_array($query)){
                echo '<div class="user_list-item">'.$row["username"].' </div>';
            }
        }
    }
    

?>

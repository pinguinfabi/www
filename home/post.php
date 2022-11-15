<?php 
    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit();
    }
    
    $visibility = 1;
    $limitPosts = 20;

    function post_blog_entries(){
        global $conn, $visibility, $limitPosts;
        // Get all blogs
        $blog_list = array();
        $query=$conn->query("SELECT article_id, title, author, created_at FROM `blog` WHERE visibility = ".$visibility." LIMIT ".$limitPosts.";");
        if($query){
            while($row = mysqli_fetch_array($query)){
                echo '<div class="blog_entry"><div class="blog_entry_readmore"><i class="fa-solid fa-right-long"></i> <a href="../blog/?id='.$row["article_id"].'">Mehr lesen</a></div>';
                echo '<div class="blog_entry_title">'.$row["title"].'</div>';
                echo '<div class="blog_entry_author">'.$row["author"].'</div>';
                echo '</div>';
            }
        }
    }
    

?>


<!-- SELECT article_id, title, author, created_at FROM `blog` WHERE visibility = ? LIMIT ? -->
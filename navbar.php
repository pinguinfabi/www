<?php 
    // Nav elements
    $nav_logout = '<li class="nav_right"><a href="/login/logout.php">Logout</a></li>';
    $nav_login = '<li class="nav_right"><a href="/login/login.html">Login</a></li>';
    $nav_register ='<li class="nav_right"><a href="/login/register.html">Registrieren</a></li>';
    $nav_home = '<li class="nav_left"><a href="/">Home</a></li>';
    $nav_create = '<li class="nav_left"><a href="/blog_create">Post erstellen</a></li>';
    $nav_archiv = '<li class="nav_left"><a href="/archiv">Archiv</a></li>';
    $nav_admin = '<li class="nav_left"><a href="/admin">Admin</a></li>';

    // Not logged in
    function navbar_notloggedin(){
        // Make Variables public
        global $nav_home, $nav_login, $nav_register;
        // Post the right elements
        echo $nav_home;
        echo $nav_register;
        echo $nav_login;
    }

    // logged in as user
    function navbar_user(){
        // Make Variables public
        global $nav_home, $nav_archiv, $nav_logout;
        // Post the right elements
        echo $nav_home;
        echo $nav_archiv;
        echo $nav_logout;
    }

    // logged in as author
    function navbar_author(){
        // Make Variables public
        global $nav_home, $nav_archiv, $nav_logout, $nav_create;
        // Post the right elements
        echo $nav_home;
        echo $nav_archiv;
        echo $nav_create;
        echo $nav_logout;
    }

    // logged in as admin
    function navbar_admin(){
        // Make Variables public
        global $nav_home, $nav_archiv, $nav_logout, $nav_create, $nav_admin;
        // Post the right elements
        echo $nav_home;
        echo $nav_archiv;
        echo $nav_create;
        echo $nav_admin;
        echo $nav_logout;
    }

    function getRoleNav($role = "not"){
        switch ($role) {
            case 'user':
                navbar_user();
                break;
            
            case 'author':
                navbar_author();
                break;
            
            case 'admin':
                navbar_admin();
                break;
            
            case 'not':
                navbar_notloggedin();
                break;
                
            default:
                navbar_notloggedin();
                break;
        }
    }

?>
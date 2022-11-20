<?php
    session_start();
    // Checks if user is logged in
    function loginCheck()
    {
        if(!isset($_SESSION['role']) || !$_SESSION['loggedin']) {
            header("Location: /login/login.html");
        }
    }
    // Checks if user has role author or higher
    function checkAuthorRole()
    {
        if ($_SESSION['role'] != "author" && $_SESSION["role"] != "admin") {
            header("Location: /?e=norights");
        }
    }
    // Checks if user has role author or higher
    function checkAdminRole()
    {
        if ( $_SESSION["role"] != "admin") {
            header("Location: /?e=norights");
        }
    }

?>

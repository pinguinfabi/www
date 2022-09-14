<?php 
    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./login.php?e=dberr");
        exit;
    }

    $email = $_POST['email'];
    $passwort_formular = $_POST['passwort'];
        
    $stmt = $conn->prepare("SELECT id, passwort, role FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $conn->close();
        header("Location: ./login.html?e=emailorpass");
        exit(); 
    }
    $stmt->bind_result($id,$passwort, $role);
    $stmt->fetch();
    //Überprüfung des Passworts
    if (password_verify($passwort_formular, $passwort)) {
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
        $_SESSION['loggedin'] = true;
        $conn->close();
        header("Location: ../index.php");
        exit();
       
    } else {

        $conn->close();
        header("Location: ./login.html?e=emailorpass");
        exit();
    }
    
?>

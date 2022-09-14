<?php
    session_start();
    require_once("../config.php");
    $conn = mysqli_connect($db_host,$db_user,$db_pass,"fabiderpinguin");
    if(mysqli_connect_errno()){
        header("Location: ./register.html?e=dberr");
        exit();
    }
 
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $username = $_POST['username'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./register.html?e=validemail");
        exit();
    }     
    if(strlen($passwort) < 7) {
        header("Location: ./register.html?e=nopass");
        exit();
    }
    if($passwort != $passwort2) {
        header("Location: ./register.html?e=samepass");
        exit();
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows != 0) {
        $conn->close();
        header("Location: ./register.html?e=emailused");
        exit(); 
    }

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows != 0) {
        $conn->close();
        header("Location: ./register.html?e=nameused");
        exit(); 
    }
    
    //Keine Fehler, wir können den Nutzer registrieren  
    $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (email,passwort) VALUES (?,?)");
    $stmt->bind_param("ss",$email,$passwort_hash);
    $stmt->execute();
    $conn->close();
    header("Location: ./login.html?e=reg");
    exit();

?>


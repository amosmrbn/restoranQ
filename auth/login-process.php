<?php
include "../config/database.php";

session_start();

if(isset($_SESSION['id'])){
    header("Location: ../dashboard");
}
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT id, name FROM users WHERE username='$username' AND password='$password' ";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        
        header('Location: ../dashboard/index.php');
    }else{
        header('Location: index.php?error=Username atau password yang anda masukan tidak valid. Silahkan masukan lagi!');
    }
}

<?php
include "../config/database.php";

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    try {
        if($id){ 
            $sql = "UPDATE users set name='$name', username='$username', password='$password' WHERE id=$id";
        }else{
            $sql = "INSERT INTO users(name, username, password) VALUE ('$name', '$username', '$password') ";
        }
        
        $result = mysqli_query($db, $sql);
        if ($result) {
            // Jika berhasil, simpan ID pengguna yang baru saja diinsert
            $user_id = mysqli_insert_id($db);

            // Redirect ke halaman utama
            header('Location: index.php?success=Ekseskusi data success');
        }else{
            header('Location: index.php?error=Ekseskusi data error');
        }
    } catch (Exception $exception) {
        header("Location: index.php?error=". $exception->getMessage());
    }
    
}

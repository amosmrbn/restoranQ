<?php
include "../config/database.php";

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category_id'];
    $note = $_POST['note'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    // die('data masuk');

    try {
        if($id){ 
            $sql = "UPDATE menus set name='$name', category_id='$category' note='$note', price='$price', status='$status' WHERE id=$id";
        }else{
            $sql = "INSERT INTO menus (name, category_id, note, price, status) VALUE ('$name', '$category_id', '$note', '$price', '$status') ";
        }
        
        $result = mysqli_query($db, $sql);
        if ($result) {
            // Jika berhasil, simpan ID pengguna yang baru saja diinsert
            $menus_id = mysqli_insert_id($db);

            // Redirect ke halaman utama
            header('Location: index.php?success=Ekseskusi data success');
        }else{
            header('Location: index.php?error=Ekseskusi data error');
        }
    } catch (Exception $exception) {
        header("Location: index.php?error=". $exception->getMessage());
    }
    
}

<?php
include "../config/database.php";

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $note = $_POST['note'];

    try {
        if($id){ 
            $sql = "UPDATE categories set name='$name', note='$note' WHERE id=$id";
        }else{
            $sql = "INSERT INTO categories(name, note) VALUE ('$name', '$note') ";
        }
        
        $result = mysqli_query($db, $sql);
        if ($result) {
            // Jika berhasil, simpan ID pengguna yang baru saja diinsert
            $category_id = mysqli_insert_id($db);

            // Redirect ke halaman utama
            header('Location: index.php?success=Ekseskusi data success');
        }else{
            header('Location: index.php?error=Ekseskusi data error');
        }
    } catch (Exception $exception) {
        header("Location: index.php?error=". $exception->getMessage());
    }
    
}

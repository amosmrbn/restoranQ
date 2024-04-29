<?php
include("../config/database.php");

session_start( );

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $status = $_POST['status'];
    try {
        if($id){ 
            $sql = "UPDATE receipts set customer_name='$customer_name', status='$status' WHERE id=$id";
        }else{
            $sql = "INSERT INTO receipts (customer_name, status, receipt_date, user_id) VALUE ('$customer_name', '$status', now(),'". $_SESSION['id']."') ";
        }
        // die($sql);    
        $result = mysqli_query($db, $sql);

        if(!$id){
            $id = mysqli_insert_id($db);
        }
        if ($result) {
            // Jika berhasil, simpan ID pengguna yang baru saja diinsert
            $receipt_id = mysqli_insert_id($db);

            // Redirect ke halaman utama
            header('Location: form.php?success=Ekseskusi data success' . "&id=$id");
        }else{
            header('Location: form.php?error=Ekseskusi data error' . "&id=$id");
        }
    } catch (Exception $exception) {
        header("Location: index.php?error=". $exception->getMessage());
    }



}else{
    die("akses dilarang...");
}
?>

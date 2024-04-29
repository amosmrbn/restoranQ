<?php
include("../config/database.php");

if(isset($_POST['submit'])) {
    $receipt_id = $_POST['receipt_id'];
    $menu_id = $_POST['menu'];
    $note = $_POST['note'];
    $amount = $_POST['amount'];

    // Get menu details from database
    $menu_query = "SELECT * FROM menu WHERE id=$menu_id";
    $menu_result = mysqli_query($db, $menu_query);
    $menu_row = mysqli_fetch_assoc($menu_result);
    $price = $menu_row['price'];
    $subtotal = $price * $amount;

    // Insert new detail into receipt_details table
    $sql = "INSERT INTO receipt_details (receipt_id, menu_id, note, amount, price, subtotal) VALUES ('$receipt_id', '$menu_id', '$note', '$amount', '$price', '$subtotal')";
    mysqli_query($db, $sql);

    // Redirect back to detail_receipt.php
    header("Location: detail_receipt.php?id=$receipt_id");
}
?>

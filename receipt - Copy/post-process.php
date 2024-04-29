<?php
include("../config/database.php");

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Insert new receipt into database
    $sql = "INSERT INTO receipts (name, status) VALUES ('$name', '$status')";
    mysqli_query($db, $sql);

    // Get ID of the newly added receipt
    $new_receipt_id = mysqli_insert_id($db);
?>

<script>
    // JavaScript to display detail receipt
    window.location.href = "detail_receipt.php?id=<?php echo $new_receipt_id; ?>";
</script>

<?php
}
?>

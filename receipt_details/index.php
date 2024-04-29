<?php include("../layout/header.php");
$sql="SELECT receipt_details.*, receipts.id AS rcp_id, 
        FROM receipt_details 
        INNER JOIN receipts ON receipts.user_id = users.id 
        ORDER BY receipts.receipt_date DESC";
$query=mysqli_query($db,$sql);

?>
    <h2 class="title-section">Receipts List</h2>
    <br>
    <?php
    if(isset($_GET['error'])) {
    ?>
    <div class="alert alert-danger">
        <?= $_GET['error']; ?>
    </div>
    <?php
    }

    if(isset($_GET['success'])) {
        ?>
    <div class="alert alert-success">
        <?= $_GET['success']; ?>
    </div>
    <?php
    }
    ?>
    <table id="my-datatables" class="table table-striped display">
    <a href="form.php" class="btn btn-primary" id="btn-add">Add</a>
    <thead>
        <tr class="text-center">
            <th class="size">No</th>
            <th>Date</th>
            <th>Name</th>
            <!-- <th>Price</th> -->
            <th>Status</th>
            <th>User</th>
            <th class="size">Action</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while($receipt = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $receipt["receipt_date"]; ?></td>
            <td><?= $receipt["customer_name"]; ?></td>
            <td><?= $receipt["status"]; ?></td>
            <td><?= $receipt["usr_name"]; ?></td>
            <td>
                <div class="d-flex">
                    <a href="form.php?id=<?= $receipt['id'];?>" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="delete-process.php" method="post">
                        <input  type="hidden" name="id" value="<?= $receipt['id']; ?>">
                        <button type="submit" name="submit" onclick="return confirm('Anda yakin menghapus data ini?');" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php
        $i++;
    }?>
</table>
<?php include("../layout/footer.php") ?>
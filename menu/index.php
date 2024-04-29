<?php include("../layout/header.php");
$sql="SELECT menus.*, categories.name AS cat_name FROM menus LEFT JOIN categories ON menus.category_id = categories.id ORDER BY menus.name";
$query=mysqli_query($db,$sql);
?>
    <h2 class="title-section">Menu List</h2>
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
            <th>Name</th>
            <th>Category</th>
            <th>Note</th>
            <th>Price</th>
            <th>Status</th>
            <th class="size">Action</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while($menu = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $menu["name"]; ?></td>
            <td><?= $menu["cat_name"]; ?></td>
            <td><?= $menu["note"]; ?></td>
            <td><?= $menu["price"]; ?></td>
            <td><?= $menu["status"]; ?></td>
            <td>
                <div class="d-flex">
                    <a href="form.php?id=<?= $menu['id'];?>" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="delete-process.php" method="POST">
                        <input  type="hidden" name="id" value="<?= $menu['id']; ?>">
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
<?php include("../layout/header.php");
$sql="SELECT * FROM categories ORDER BY name";
$query=mysqli_query($db,$sql);
?>
    <h2 class="title-section">Categories List</h2>
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
            <th>Note</th>
            <th class="size">Action</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while($category = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $category["name"]; ?></td>
            <td><?= $category["note"]; ?></td>
            <td>
                <div class="d-flex">
                    <a href="form.php?id=<?= $category['id'];?>" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="delete-process.php" method="post">
                        <input  type="hidden" name="id" value="<?= $category['id']; ?>">
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
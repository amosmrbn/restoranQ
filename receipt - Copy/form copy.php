<?php 
    include("../layout/header.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $sql = "SELECT * FROM receipts WHERE id=$id";
    $result = mysqli_query($db, $sql);
    $receipt = $result->num_rows > 0 ? mysqli_fetch_assoc($result) : null;
?>
        
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7 ">
                <div class="card" style="width: 620px;">
                    <div class="card-header text-center ">
                        <h2 class="title-section my-3"><?= $id ? "Edit" : "Add"; ?> Receipts</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="post-process.php" >
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $receipt ? $receipt['name'] : ''?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Entry</option>
                                    <option value="">Done</option>
                                </select>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning" name="submit" style="width:50%;">Save</button>
                                <a href="index.php" class="btn btn-danger" style="width: 50%;">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </div>

<?php include("../layout/footer.php") ?>
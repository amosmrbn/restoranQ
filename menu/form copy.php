<?php 
    include("../layout/header.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $sql = "SELECT * FROM menus WHERE id=$id";
    $result = mysqli_query($db, $sql);
    $menu = $result->num_rows > 0 ? mysqli_fetch_assoc($result) : null;
    
?>
        
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7 mt-5 ">
                <div class="card" style="width: 620px;">
                    <div class="card-header text-center ">
                        <h2 class="title-section my-3"><?= $id ? "Edit" : "Add"; ?> Menu</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="post-process.php" >
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $menu ? $menu['name'] : ''?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <?php
                                    $cat = $menu['category_id'];
                                    $cat_sql = "SELECT id, name FROM categories";
                                    $cat_query = mysqli_query($db, $cat_sql);
                                    
                                    while($category = mysqli_fetch_assoc($cat_query)) {
                                        $cat_id = $category['id'];
                                        $cat_name = $category['name'];
                                        $selected = ($cat_id == $cat) ? 'selected' : ''; 
                                        
                                        echo "<option value='$cat_id' $selected>$cat_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" value="<?= $menu ? $menu['price'] : ''?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" name="note" value="<?= $menu ? $menu['note'] : ''?>" >
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" name="status" value="<?= $menu ? $menu['status'] : ''?>" required>
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
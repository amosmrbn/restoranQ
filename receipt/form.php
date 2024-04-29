<?php 
    include("../layout/header.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $sql = "SELECT * FROM receipts WHERE id=$id";
    $result = mysqli_query($db, $sql);
    $receipt = $result->num_rows > 0 ? mysqli_fetch_assoc($result) : null;
?>
        
<div class="container mt-5">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="card" style="width: 920px; margin-left:65px">
                <div class="card-header text-center ">
                    <h2 class="title-section "><?= $id ? "Edit" : "Add"; ?> Receipts</h2>
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
                </div>
                <div class="card-body">
                    <form method="POST" action="receipt-post-process.php" class="mb-5">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" value="<?= $receipt ? $receipt['customer_name'] : ''?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Entry" <?= $receipt && $receipt['status'] == 'Entry' ? 'selected' : '' ?>>Entry</option>
                                <option value="Done" <?= $receipt && $receipt['status'] == 'Done' ? 'selected' : '' ?>>Done</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning" name="submit" style="width:50%;">Save Receipt</button>
                            <a href="index.php" class="btn btn-danger" style="width: 50%;">Back</a>
                        </div>
                    </form>
                </div>
                <?php if($id > 0): ?>
                <?php
                $sql="SELECT rd.*, m.name as menu_name,c.name as category_name, (rd.price * rd.amount) as subtotal
                    from receipt_details as rd
                    inner join menus as m on rd.menu_id=m.id
                    inner join categories as c on m.category_id=c.id
                    where rd.receipt_id=$id;";
                $query=mysqli_query($db,$sql);    

                // Inisialisasi total
                $total = 0;
                ?>


                <table id="my-datatables" class="table table-striped table-bordered">
                    <button type="button" style="color:white;" class="btn" id="btn-add" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                    <!-- Modal untuk form detail receipt -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAddLabel">Detail Receipt</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="detail-receipt-post-process.php">
                                        <input type="hidden" name="modal_receipt_id" value="<?= $id; ?>">
                                        <div class="mb-3">
                                            <label for="modal_menu_id" class="form-label">Menu</label>
                                            <select name="modal_menu_id" class="form-select">
                                                <?php
                                                $sql = "SELECT id, name, price FROM menus ORDER BY name";
                                                $result = mysqli_query($db, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $menu_id = $row['id'];
                                                        $menu_name = $row['name'];
                                                        $menu_price = $row['price'];
                                                        echo "<option value='$menu_id'>$menu_name - $menu_price</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No menu available</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modal_amount" class="form-label">Amount</label>
                                            <input type="number" class="form-control" name="modal_amount" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modal_note" class="form-label">Note</label>
                                            <input type="text" class="form-control" name="modal_note">
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-warning" name="submit">Save</button>
                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <thead>
                        <tr class="text-center">
                            <th class="size">No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Note</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Subtotal</th>
                            <th class="size">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while($receipt_detail = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $receipt_detail["menu_name"]; ?></td>
                            <td><?= $receipt_detail["category_name"]; ?></td>
                            <td><?= $receipt_detail["note"]; ?></td>
                            <td><?= $receipt_detail["price"]; ?></td>
                            <td><?= $receipt_detail["amount"]; ?></td>
                            <td><?= number_format($receipt_detail["subtotal"], 0, '.', '.'); ?></td>
                            <td>
                                <div class="d-flex">
                                    
                                    <form action="detail-delete-process.php" method="post">
                                        <input type="hidden" name="id" value="<?=  $receipt_detail["id"]; ?>">
                                        <input type="hidden" name="receipt_id" value="<?= $id; ?>">
                                        <button type="submit" name="submit"
                                            onclick="return confirm('Anda yakin menghapus data ini?');"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php
                        // Tambahkan subtotal ke total
                        $total += $receipt_detail["subtotal"];
                        $i++;
                    }?>
                    <tfoot>
                        <tr style="font-weight: bolder;">
                            <td colspan="6" class="text-end" >Total</td>
                            <td><?= number_format($total, 0, '.', '.'); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table> 
            <?php endif; ?>


            </div>
        </div>
    </div>
</div>

<?php include("../layout/footer.php") ?>

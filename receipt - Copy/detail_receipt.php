<?php 
    include("../layout/header.php");

    $receipt_id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Fetch receipt details from the database based on receipt ID
    $sql = "SELECT * FROM receipt_details WHERE receipt_id=$receipt_id";
    $result = mysqli_query($db, $sql);
    $details = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $details[] = $row;
    }

    // Fetch menu options from the database
    $menu_query = "SELECT * FROM menu";
    $menu_result = mysqli_query($db, $menu_query);
?>
        
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center ">
                    <h2 class="title-section my-3">Detail Receipt</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <!-- Form to add new detail to receipt -->
                        <button class="btn btn-primary" id="add-detail" data-bs-toggle="modal" data-bs-target="#addDetailModal">Add</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Note</th>
                                <th>Amount</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through details and display them -->
                            <?php foreach ($details as $index => $detail) { ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $detail['name'] ?></td>
                                <td><?= $detail['category'] ?></td>
                                <td><?= $detail['price'] ?></td>
                                <td><?= $detail['note'] ?></td>
                                <td><?= $detail['amount'] ?></td>
                                <td><?= $detail['subtotal'] ?></td>
                                <td>Action</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal to add new detail -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDetailModalLabel">Add Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="form-detail-receipt">
                <form method="POST" action="post-detail-process.php">
                    <!-- Form fields to add new detail -->
                    <!-- Replace these fields with your actual form fields -->
                    <input type="hidden" name="receipt_id" value="<?= $receipt_id ?>">
                    <div class="mb-3">
                        <label for="menu" class="form-label">Menu</label>
                        <select name="menu" class="form-select">
                            <?php while ($menu_row = mysqli_fetch_assoc($menu_result)) { ?>
                                <option value="<?= $menu_row['id'] ?>"><?= $menu_row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Detail</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#addDetailModal').modal('hide'); // Ensure modal is hidden by default
        $('#add-detail').click(function() {
            $('#addDetailModal').modal({show: false}); // Show the modal when clicked
        });
        
        $("#form-detail-receipt").on("submit", function (event) {  
            event.preventDefault();   
            
            $.ajax({    // Make AJAX request 
              url: "post-detail-process.php",    // Specify the file to execute in server side scripting language
              url: "post-detail-process.php",    // Specify the file to execute
              data: $(this).serialize(),      // Pass all form values
              type: 'post',     // Set the type of request to POST
              success: function(data){
                  var result = JSON.parse(data);
                  
                  if (result["status"] == "success"){
                      alert("Successfully added detail!");
                      
                      location.reload(); // Reload page after successful submission
                  } else {
                      alert("Failed to add detail! Please try again.");
                  };
              },
              error: function () {
                  alert("Error occurred while adding detail! Please try again.")
              }
           })   
        });
    });
</script>


<?php include("../layout/footer.php") ?>

<?php
session_start();

if(isset($_SESSION['id'])){
    header("Location: ../dashboard");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RestoranQ</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center text-warning">
                        <h3>Login RestoranQ</h3>
                    </div>
                        <?php
                            if(isset($_GET['error'])) {
                        ?>
                            <div class="alert alert-danger text-center">
                                <?= $_GET['error']; ?>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="card-body">
                            <form method="POST" action="login-process.php" >
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-warning" name="submit" style="width: 100%;">Login</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include "../config/database.php";

session_start();

if(!isset($_SESSION['id'])){
    header( "Location: ../auth" );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoranQ</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Data tables -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <nav class="navbar bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../dashboard">RestoranQ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-warning" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">RestoranQ</h5>
                    <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-1">
                        <li class="nav-item">
                            <a class="nav-link  <?= str_contains($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : ""; ?>"
                                aria-current="page" href="../dashboard">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'receipt') ? 'active' : ""; ?> || <?= str_contains($_SERVER['REQUEST_URI'], 'report') ? 'active' : ""; ?> dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transaction
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item text-warning" href="../receipt/">Receipts</a></li>
                                <li><a class="dropdown-item text-warning" href="#">Report</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'user') ? 'active' : ""; ?> || <?= str_contains($_SERVER['REQUEST_URI'], 'category') ? 'active' : ""; ?> || <?= str_contains($_SERVER['REQUEST_URI'], 'menu') ? 'active' : ""; ?> dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Master Data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item text-warning" href="../user">User</a></li>
                                <li><a class="dropdown-item text-warning" href="../category/">Category</a></li>
                                <li><a class="dropdown-item text-warning" href="../menu">Menu</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../auth/logout-process.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="container" style="margin-top: 80px";>
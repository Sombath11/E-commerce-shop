<?php

    include('../server/connection.php');

    session_start();

    //if admin is not logged in
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;

    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SABEON</title>

    <link rel="shortcut icon" href="./assets/imgs/sabeon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">    

    <link rel="stylesheet" href="./assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

    <!-- sideMenu -->
     <section id="menu">
        <div class="logo">
            <img src="./assets/imgs/sabeon.png" alt="logo">
            <h2>Dashboard</h2>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-chart-pie"></i><a href="./index.php">Dashboard</a></li>
            <li><i class="fa-brands fa-uikit"></i><a href="./index.php">Orders</a></li>
            <li><i class="fa-solid fa-table-cells-large"></i><a href="./products.php">Products</a></li>
            <li><i class="fa-solid fa-edit"></i><a href="./account.php">Account</a></li>
            <li><i class="fa-brands fa-cc-visa"></i></i><a href="./add_product.php">Add Product</a></li>
            <!-- <li><i class="fa-brands fa-cc-visa"></i></i><a href="./add_sales.php">Add Sales</a></li> -->
            <li><i class="fa-solid fa-hamburger"></i><a href="./contact.php">Contact</a></li>
            <li><i class="fa-solid fa-chart-line"></i><a href="./help.php">Help</a></li>
        </div>
 
     </section>
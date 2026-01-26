<?php 
    
    session_start();

    // include('../server/connection.php')

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>SABEON</title>
    
    <link rel="shortcut icon" href="./assets/imgs/sabeon.png" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <header>
      <!-- navbar -->
      <nav
        class="navbar navbar-expand-lg bg-white navbar-light bg-light fixed-top py-3"
      >
        <div class="container">
          <a class="navbar-brand" href="#">
            <img class="logo" src="./assets/imgs/sabeon.png" alt="Logo" />
          </a>
          <!-- <h2 class="brand">Sabeon</h2> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"  >
            <span span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent"  >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="./index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./contact.php">Contact Us</a>
              </li>

              <li class="nav-item">
                <a href="cart.php">
                  <i class="fa-solid fa-bag-shopping">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                      <span class="cart_quantity"><?php echo $_SESSION['quantity']; ?></span>
                    <?php }?>
                  </i>
                </a>
                <a href="account.php"><i class="fa-solid fa-user"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
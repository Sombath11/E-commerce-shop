

<?php include('layouts/header.php'); ?>


<?php

  include 'server/connection.php';
 
  if(isset($_SESSION['logged_in'])){
    header('location:account.php');
    exit();
  }

  if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ? limit 1");
    $stmt->bind_param("ss", $email, $password);
 
    if($stmt->execute()){
      $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
      $stmt->store_result();

      if($stmt->num_rows() == 1){
        $stmt->fetch();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header('location: account.php?login_success=logged in successfully');


      }else{
        header('location: login.php?error=could not verify your account');
      }

    }else{
      //error 
      header('location: login.php?error=something went wrong');
    }

  }



?>






    <!-- login -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
      </div>
      <div class="mx-auto container">
        <form action="login.php" id="login-form" method="post">
          <p style="color: red;" class="text-center"><?php if(isset($_GET['error'])) echo $_GET['error']; ?></p>
          <div class="form-group">
            <label for="login-email">Email</label>
            <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter your email" required/>
          </div>
          <div class="form-group">
            <label for="login-password">Password</label>
            <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter your password" required/>
          </div>
          <div class="form-group">
            <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
          </div>
          <div class="form-group">
            <a href="register.php" id="register-url" class="btn">Don't have account? Register</a>
          </div>
        </form>
      </div>
    </section>











    <!-- footer -->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <img class="logo" src="./assets/imgs/logo.png" alt="logo" class="img-fluid">
          <p class="pt-3">
            WE provide the best product for the most affordable price
          </p>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Featured</h5>
          <ul class="text-uppercase">
            <li><a href="#">men</a></li>
            <li><a href="#">women</a></li>
            <li><a href="#">boys</a></li>
            <li><a href="#">girls</a></li>
            <li><a href="#">new arrivals</a></li>
            <li><a href="#">clothes</a></li>
          </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Contact Us</h5>
          <div>
            <h6 class="text-uppercase">Address</h6>
            <p>123 E-commerce St, Online City, Webland</p>
          </div>
          <div>
            <h6 class="text-uppercase">Phone</h6>
            <p>(123) 456-7890</p>
          </div>
          <div>
            <h6 class="text-uppercase">Phone</h6>
            <p>(123) 456-7890</p>
          </div>
          <div>
            <h6 class="text-uppercase">Email</h6>
            <p>info@ecommerce.com</p>
          </div>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
                <img src="./assets/imgs/logo.png" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/imgs/logo.png" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/imgs/logo.png" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/imgs/logo.png" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="./assets/imgs/logo.png" alt="" class="img-fluid w-25 h-100 m-2">
            </div>
        </div>
      </div>



      <div class="copyright mt-5">
        <div class="row container mx-auto">
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
            <img src="./assets/imgs/logo.png" alt="logo" class="img-fluid">
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <p>e-commerce @2025 All rights reserved.</p>
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>



 <?php include('layouts/footer.php'); ?>

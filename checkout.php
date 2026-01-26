
<?php include('layouts/header.php'); ?>


<?php

  if (!empty($_SESSION['cart'])) {
      
    //let user in



    //send user to home page
  }else{
    header('Location: index.php');
  }


?>








    <!-- checkout -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-width-bold">Check Out</h2>
        <hr class="mx-auto">
      </div>
      <div class="mx-auto container">
        <form action="./server/place_order.php" id="checkout-form" method="post">
          <p class="text-center" style="color: red;">
            <?php if(isset($_GET['message'])) {echo $_GET['message'];} ?>
            <?php if(isset($_GET['message'])) { ?>
              <a class="btn btn-primary" href="login.php">Login</a>
            <?php } ?>
            
          </p>
          <div class="form-group checkout-small-element">
            <label for="checkout">Name</label>
            <input type="text" class="form-control" id="checkout" name="name" placeholder="Enter your name" required/>
          </div>
          <div class="form-group checkout-small-element">
            <label for="checkout-email">Email</label>
            <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Enter your email" required/>
          </div>
          <div class="form-group checkout-small-element">
            <label for="checkout-phone">Phone</label>
            <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Enter your phone" required/>
          </div>
          <div class="form-group checkout-small-element">
            <label>City</label>
            <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
          </div>
          <div class="form-group checkout-large-element">
            <label>Address</label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required/>
          </div>
          <div class="form-group checkout-btn-container">
            <p>Total amount: $ <?php echo $_SESSION['total']; ?></p>
            <input type="submit" class="btn checkout-btn" name="place_order" id="checkout-btn" value="Place Order"/>
          </div>
        </form>
      </div>
    </section>






<?php include('layouts/footer.php'); ?>
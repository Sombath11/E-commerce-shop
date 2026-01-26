

<?php include('layouts/header.php'); ?>


<?php


  if( isset($_POST['order_pay_btn']) ){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
  }

  


?>






    <!-- payment -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-width-bold">Payment</h2>
        <hr class="mx-auto">
      </div>
      <div class="mx-auto container text-center">


      <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
        <?php $amount = strval($_POST['order_total_price']) ; ?>
        <?php $order_id = $_POST['order_id']; ?>
        <p>Total payment: $<?php echo $_POST['order_total_price']; ?>  </p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->
         
        <div id="paypal-button-container" style="max-width: 600px; margin: 0 auto;"></div>
        

      <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
        <?php $order_id = $_SESSION['order_id']; ?>
        <?php $amount = strval($_SESSION['total']);  ?>
        <p>Total payment: $<?php echo $_SESSION['total'];  ?></p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->

        <div id="paypal-button-container" style="max-width: 600px; margin: 0 auto;"></div>

      <?php } else { ?>
        <p>You don't have an order</p>
      <?php } ?>

      

      </div>
    </section>



 

    
    <!-- Initialize the JS-SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Ad7gnzWigH65tgpF6Y7KDUBkKVXVY3vk-oRDEcIu_VlVrOjd02AfzbYcDD7IS06GhTaikkIEDz7_-yff&buyer-country=US&currency=USD&components=buttons&enable-funding=card&disable-funding=venmo,paylater" data-sdk-integration-source="developer-studio"></script>
    <script src="./src/app.js"></script>






<?php include('layouts/footer.php'); ?>

<?php include('layouts/header.php'); ?>

<?php


  if (isset($_POST['add_to_cart'])) {

    //if user has already added a product to cart
    if (isset($_SESSION['cart'])) {
      
      $product_array_ids = array_column($_SESSION['cart'], 'product_id');  //[2,3,4,10,15]
      // product already exists in cart
      if ( !in_array($_POST['product_id'], $product_array_ids )) {
        
        $product_id = $_POST['product_id'];

        $product_array = array(
                      'product_id' => $_POST['product_id'],
                      'product_image' => $_POST['product_image'],
                      'product_name' => $_POST['product_name'],
                      'product_price' => $_POST['product_price'],
                      'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$product_id] = $product_array;


      //product does not exist in cart 
      } else {
        echo "<script>alert('product was already added to cart');</script>";
       
      }

      //if this is the first product
    }else{
      $product_id = $_POST['product_id'];
      $product_image = $_POST['product_image'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
                      'product_id' => $product_id,
                      'product_image' => $product_image,
                      'product_name' => $product_name,
                      'product_price' => $product_price,
                      'product_quantity' => $product_quantity
      );

      $_SESSION['cart'][$product_id] = $product_array;
      // [ 2=>[] , 3=>[] , s=>[] ]
    } 

    // Calculate the total
    calculateTotal();









  }else if (isset($_POST['remove_product'])) {

    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);


    // Calculate the total
    calculateTotal();



  
  }else if (isset($_POST['edit_quantity'])) {

    // we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // we get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    // we update the quantity
    $product_array['product_quantity'] = $product_quantity;

    // we save the updated array back to session
    $_SESSION['cart'][$product_id] = $product_array;


    // Calculate the total
    calculateTotal();


  }else{
    // header('Location: index.php ');
  }

 
  function calculateTotal() {
    $total_price = 0;
    $total_quantity = 0;
    foreach ($_SESSION['cart'] as $key => $value) {

      $product = $_SESSION['cart'][$key];

      $price = $product['product_price'];
      $quantity = $product['product_quantity'];

      $total_price = $total_price + ($price * $quantity);
      $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
  }

?>




    
    <!-- cart -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
          <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Subtotal</th>
          </tr>

          <?php if (isset($_SESSION['cart'])){?>

          

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

              <tr>
                  <td>
                      <div class="product-info">
                          <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="">
                          <div>
                              <p><?php echo $value['product_name']; ?></p>
                              <small><span>$</span><?php echo $value['product_price']; ?></small>
                              <br>
                              <form action="cart.php" method="POST">
                                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                  <input type="submit" name="remove_product" class="remove-btn" value="Remove" >
                              </form>
                          </div>
                      </div>
                  </td>

                  <td>
                      <form method="post" action="cart.php">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                          <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                          <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
                      </form>
                      
                  </td>

                  <td>
                      <span>$</span>
                      <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity']; ?></span>
                  </td>
              </tr>      

            <?php } ?> 

          <?php } ?> 

        </table>

        <div class="cart-total">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr> -->
                <tr>
                    <td>Total</td>
                    <?php if(isset($_SESSION['cart'])){?>
                      <td>$<?php echo $_SESSION['total']; ?></td>
                    <?php }?>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
          <form method="post" action="checkout.php">
            <input type="submit" class="btn checkout-btn" name="checkout" value="Checkout">
          </form>
        </div>

    </section>




<?php include('layouts/footer.php'); ?>

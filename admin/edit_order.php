<?php include('header.php'); ?>


     <!-- Interface -->
      <section id="interface">
        
      <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Update Order</h3>

        <?php 

            if(!isset($_GET['order_id']) || !isset($_GET['order_cost']) || !isset($_GET['order_date'])){
                header("location: index.php?error_message=Missing order information");
                exit();
            }
        ?>

        <div class="container-fluid w-50 my-5">
            <form method="POST" action="update_order.php">
                <div class="mb-2 form-group">
                    <label>OrderId</label>
                    <p class="form-control"><?php echo $_GET['order_id']; ?></p>
                    <input type="hidden" name="order_id" value="<?php echo $_GET['order_id'] ?>">
                </div>

                <div class="mb-2 form-group">
                    <label>OrderPrice</label>
                    <p class="form-control">$<?php echo $_GET['order_cost']; ?></p>
                    <input type="hidden" name="order_cost" value="<?php echo $_GET['order_cost']; ?>">
                </div>

                <div class="form-group mb-2">
                    <label for="">Order Status</label>
                    <select class="form-select" required name="category" id="">
                        <option value="not paid">Not Paid</option>
                        <option value="paid">Paid</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>

                <div class="mb-2 form-group">
                    <label>OrderDate</label>
                    <p class="form-control"><?php echo $_GET['order_date']; ?></p>
                    <input type="hidden" id="date" name="date" class="form-control" value="<?php echo $_GET['order_date']; ?>">
                </div>

                <div class="mb-2 text-center">
                    <input type="submit" value="Update" name="update_order_btn" id="update_order_btn" class="btn btn-primary mt-3"> 
                </div>

            </form>
        </div>
       




       
        


      </section>
    



    <script>
        $('#menu-btn').click(
            function(){
                $('#menu').toggleClass('active');
            }
        );
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
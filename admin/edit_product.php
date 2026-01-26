


<?php include('header.php'); ?>

     <!-- Interface -->
    <section id="interface">
        
      
      <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Update Product</h3>
        

        <?php 

            if(!isset($_GET['product_id'])){
                header("location: products.php?error_message=product id was not given");
                exit();
            }
        ?>
 
        <div class="container-fluid w-50 my-5">
            <form action="update_product.php" method="POST">
                <div class="mb-2 form-group">
                    <label>Product Id</label>
                    <p class="form-control"><?php echo $_GET['product_id']; ?></p>
                    <input type="hidden" name="product_id" value="<?php echo $_GET['product_id'] ?>">
                </div>
                <div class="mb-2 form-group">
                    <label>Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title">
                </div>

                 <div class="mb-2 form-group">
                    <label>Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Description">
                </div>

                 <div class="mb-2 form-group">
                    <label>Price</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="Price">
                </div>

                <label>Category</label>
                <select class="form-select mb-2" name="category" id="category">
                    <option value="shoes">Shoes</option>
                    <option value="bags">Bags</option>
                    <option value="coats">Coats</option>
                    <option value="watches">Watches</option>
                </select>

                <div class="mb-2 form-group">
                    <label>Color</label>
                    <input type="text" id="color" name="color" class="form-control" placeholder="Color">
                </div>

                <div class="mb-2 form-group">
                    <label>Special Offer/Sale</label>
                    <input type="text" id="special_offer" name="special_offer" class="form-control" placeholder="Sale %">
                </div>

                <div class="mb-2 text-center">
                    <input type="submit" value="Update" name="update_product_btn" id="update_product_btn" class="btn btn-primary mt-3"> 
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




<?php include('header.php'); ?>


     <!-- Interface -->
      <section id="interface">
        
      
      <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Update Product Image</h3>
 
        <?php 

            if(!isset($_GET['product_id'])){
                header("location: products.php?error_message=product id was not given");
                exit();
            }
        ?>

        <div class="container-fluid w-50 my-5">
            <form method="POST" enctype="multipart/form-data" action="update_product_image.php">
                <div class="mb-2 form-group">
                    <label>Product Id</label>
                    <p class="form-control"><?php echo $_GET['product_id']; ?></p>
                    <input type="hidden" name="product_id" value="<?php echo $_GET['product_id'] ?>">
                    <input type="hidden" name="product_name" value="<?php echo $_GET['product_name'] ?>">
                </div>

                 <div class="mb-2 form-group">
                    <label>Image 1</label>
                    <input type="file" id="image1" name="image1" class="form-control" placeholder="Image 1" required>
                </div>

                <div class="mb-2 form-group">
                    <label>Image 2</label>
                    <input type="file" id="image2" name="image2" class="form-control" placeholder="Image 2" required>
                </div>

                <div class="mb-2 form-group">
                    <label>Image 3</label>
                    <input type="file" id="image3" name="image3" class="form-control" placeholder="Image 3" required>
                </div>

                <div class="mb-2 form-group">
                    <label>Image 4</label>
                    <input type="file" id="image4" name="image4" class="form-control" placeholder="Image 4" required>
                </div>

                
                <div class="mb-2 text-center">
                    <input type="submit" value="Update" name="update_product_image_btn" id="update_product_image_btn" class="btn btn-primary mt-3"> 
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
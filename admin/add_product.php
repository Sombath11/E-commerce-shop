<?php include('header.php'); ?>


     <!-- Interface -->
      <section id="interface">
         
      
      <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Add New Product</h3>

        <div class="container-fluid w-50 my-5">
            <form action="create_product.php" method="post" enctype="multipart/form-data">
                
                <div class="mb-2 form-group">
                    <label>Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
                </div>

                 <div class="mb-2 form-group">
                    <label>Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
                </div>

                 <div class="mb-2 form-group">
                    <label>Price</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="Price" required>
                </div>

                 <div class="mb-2 form-group">
                    <label>Special Offer/Sale</label>
                    <input type="text" id="special_offer" name="special_offer" class="form-control" placeholder="Sale %">
                </div>

                <div class="mb-2 form-group">
                    <label for="">Category</label>
                    <select class="form-select mb-2" required name="category">
                        <option value="shoes">Shoes</option>
                        <option value="bags">Bags</option>
                        <option value="cloths">Cloths</option>
                        <option value="watches">Watches</option>
                    </select>
                </div>

                <div class="mb-2 form-group">
                    <label for="">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Color" required>
                </div>
                

                <div class="mb-3 form-group">
                    <label>Image 1</label>
                    <input type="file" id="image1" name="image1" class="form-control" placeholder="Image 1" required>
                </div>

                <div class="mb-3 form-group">
                    <label>Image 2</label>
                    <input type="file" id="image2" name="image2" class="form-control" placeholder="Image 2" required>
                </div>

                <div class="mb-3 form-group">
                    <label>Image 3</label>
                    <input type="file" id="image3" name="image3" class="form-control" placeholder="Image 3" required>
                </div>

                <div class="mb-3 form-group">
                    <label>Image 4</label>
                    <input type="file" id="image4" name="image4" class="form-control" placeholder="Image 4" required>
                </div>

                <div class="mb-2 text-center">
                    <input type="submit" value="Add Product" name="add-product-btn" id="add-product-btn" class="btn btn-primary mt-3"> 
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
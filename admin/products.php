
<!-- get product -->
<?php 

    include("connection.php");

    //1.determine page  no
    if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }


    //2.return  number of products
    $stmt1 = $conn->prepare("select count(*) as total_products from products");
    $stmt1->execute();
    $stmt1->bind_result($total_products);
    $stmt1->store_result();
    $stmt1->fetch();
    
     
    //3.products per page
    $total_products_per_page = 5;

    $offset = ($page_no-1) * $total_products_per_page;

    $total_no_of_pages = ceil($total_products/$total_products_per_page);
    
    
    //4.get all products
    $stmt2 = $conn->prepare("select * from products limit $offset, $total_products_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();
    
?>


 

<?php include('header.php'); ?>


     <!-- Interface -->
      <section id="interface">
        
      
      <?php include('navigation.php'); ?>

        

        <!-- Title -->
        <h3 class="i-name">Products</h3>

        <?php include('messages.php'); ?>

         <!-- Table -->
          <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Product Id</td>
                        <td>Product Name</td>
                        <td>Product Price</td>
                        <td>Product Offer</td>
                        <td>product Category</td>
                        <td>Product Color</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>

 
                <?php foreach($products as $product) { ?>

                    <tbody>
                        <tr>
                            <td>
                                <h5><?php echo $product['product_id']; ?></h5>
                            </td>
                            <td class="people">
                                <p><img src="../assets/imgs/<?php echo $product['product_image']; ?>" alt=""></p>
                                <div class="people-description">
                                    <h5><?php echo $product['product_name']; ?></h5>
                                </div>
                            </td>

                            <td class="role">
                                <p>$<?php echo $product['product_price']; ?></p>
                            </td>

                            <td class="role">
                                <p><?php echo $product['product_special_offer']; ?>%</p>
                            </td>

                            <td class="people-des">
                                <h5><?php echo $product['product_category']; ?></h5>
                            </td>

                            <td class="active">
                                <p><?php echo $product['product_color']; ?></p>
                            </td>

                            <td class="edit">
                                <p><a href="<?php echo "edit_product.php?product_id=".$product['product_id']; ?>">Edit</a></p>
                            </td>

                            <td class="edit">
                                <p><a href="edit_product_image.php?product_id=<?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>&product_name=<?php echo urlencode($product['product_name']); ?>">Edit Image</a></p>
                            </td>

                            <td class="edit">
                                <p><a href="<?php echo "delete_product.php?product_id=".$product['product_id']; ?>">Delete</a></p>
                            </td>
                        </tr>   
                    </tbody>

                <?php } ?>

            </table>
            
          </div>




        <nav class="container mx-3" aria-label="Page navigation example">
            <ul class="pagination">

                <li class="page-item <?php if($page_no<=1){echo 'disabled';}  ?>">
                    <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo '?page_no='.($page_no-1);} ?>">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page_no=1">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page_no=2">2</a>
                </li>
                <?php if($page_no>=3){ ?>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page_no=". ($page_no);?>"><?php echo $page_no; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}  ?>">
                    <a class="page-link" href="<?php if($page_no>= $total_no_of_pages){echo '#';}else{echo '?page_no='.($page_no+1);} ?>">Next</a>
                </li>
            </ul>
        </nav>
        


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
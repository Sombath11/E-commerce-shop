
<?php include('header.php'); ?>



<?php

    //1. determine page
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
      //if user has already entered page then page number is the one that they selected
      $page_no = $_GET['page_no'];
    }else{
      //if user just entered the page then default page is 1
      $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) as total_records FROM orders");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result(); 

    $stmt1->fetch();

    //3.products per page
    $total_records_per_page = 5;

    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_page = ceil($total_records/$total_records_per_page);

    //4. get all products

    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");

    $stmt2->execute();

    $orders = $stmt2->get_result();






?>

     <!-- Interface -->
      <section id="interface">
        

        <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Dashboard</h3>

        <?php include('messages.php'); ?>
        

        <?php include('get_stats.php') ?>


        <!-- card -->
         <div class="values">

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                   <h3><?php if($total_users != null) { echo $total_users; } ?></h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-shopping-cart"></i>
                <div>
                    <h3><?php if($total_products != null) { echo $total_products; } ?></h3>
                    <span>Products</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-brands fa-sellsy"></i>
                <div>
                    <h3><?php if($total_quantity != null) { echo $total_quantity; } ?></h3>
                    <span>Sold</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-dollar-sign"></i>
                <div>
                    <h3>$<?php if($total_money != null) { echo $total_money; } ?></h3>
                    <span>Revenue</span>
                </div>
            </div>

         </div>

         


         <!-- Table -->
          <div class="board">
            <h3 class="i-name">Orders</h3>
            <table width="100%">
                <thead>
                    <tr>
                        <td>Order Id</td>
                        <td>Order Status</td>
                        <td>User Id</td>
                        <td>Order Date</td>
                        <td>User Phone</td>
                        <td>User Address</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td class="people-des">
                                <h5><?php echo $order['order_id']; ?></h5>
                            </td>

                            <td class="active">
                                <p><?php echo $order['order_status']; ?></p>
                            </td>

                            <td class="role">
                                <p><?php echo $order['user_id']; ?></p>
                            </td>

                            <td class="role">
                                <p><?php echo $order['order_date']; ?></p>
                            </td>

                            <td class="role">
                                <p><?php echo $order['user_phone']; ?></p>
                            </td>

                            <td class="role">
                                <p><?php echo $order['user_address']; ?></p>
                            </td>

                            <td>
                                <p><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>&order_cost=<?php echo $order['order_cost']; ?>&order_date=<?php echo $order['order_date']; ?>">Edit</a></p>
                            </td>

                            <td>
                                <p><a class="btn btn-danger" href="<?php echo "delete_order.php?order_id=" . $order['order_id']; ?>">Delete</a></p>
                            </td>


                        </tr>

                    <?php } ?>
                </tbody>

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




    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> -->
</body>
</html>
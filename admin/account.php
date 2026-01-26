<?php include('header.php'); ?>


     <!-- Interface -->
      <section id="interface">
        
      
      <?php include('navigation.php'); ?>

        <!-- Title -->
        <h3 class="i-name">Admin Account</h3>

        <div class="container-fluid w-50 my-5">
           <p>ID: <?php echo $_SESSION['admin_id']; ?></p>
           <p>Name: <?php echo $_SESSION['admin_name']; ?></p>
           <p>Email: <?php echo $_SESSION['admin_email']; ?></p>
           <p><a href="logout.php">Logout</a></p>
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
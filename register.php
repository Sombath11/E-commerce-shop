

<?php include('layouts/header.php'); ?>


<?php
  

  include 'server/connection.php';

  //if user has already registered, then take user to account page
  if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
  }


  if (isset($_POST['register'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    //if passwords don't match
    if ($password !== $confirm_password) {
      header("Location: register.php?error=passwords don't match");
    } 

    //if password is less than 6 characters
    else if(strlen($password) < 6){
      header('location: register.php?error=password must be at least 6 characters');
    }

    // if there is no error
    else {
            //check whether there is a user with email or not
            $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
            $stmt1->bind_param("s", $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();

            //if there is a user already registered with this email
            if($num_rows > 0){
              header('location: register.php?error=user with this email already exists');

            //if no user registered with this email before
            }else{
                  //create new user
                  $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) 
                                          VALUES (?, ?, ?)");

                  $hashed_password = md5($password);
                  $stmt->bind_param("sss", $name, $email, $hashed_password);



                  //if account was created successfully
                  if($stmt->execute()){
                    $user_id = $stmt->insert_id;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register_success=You registered successfully');
                  
                  //account could not be created
                  }else{
                    header('location: register.php?register_error=could not create an account at the moment');
                  }
            }
    }

  }
















?>








    <!-- register -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weigth-bold">Register</h2>
        <hr class="mx-auto">
      </div>
      <div class="mx-auto container">
        <form action="register.php" id="register-form" method="post">

          <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

          <div class="form-group">
            <label for="register-name">Name</label>
            <input type="text" class="form-control" id="register-name" name="name" placeholder="Enter your name" required/>
          </div>
          <div class="form-group">
            <label for="register-email">Email</label>
            <input type="email" class="form-control" id="register-email" name="email" placeholder="Enter your email" required/>
          </div>
          <div class="form-group">
            <label for="register-password">Password</label>
            <input type="password" class="form-control" id="register-password" name="password" placeholder="Enter your password" required/>
          </div>
          <div class="form-group">
            <label for="register-confirm-password">Confirm Password</label>
            <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm your password" required/>
          </div>
          <div class="form-group">
            <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
          </div>
          <div class="form-group">
            <a href="login.php" id="login-url" class="btn">Do you have an account? Login</a>
          </div>
        </form>
      </div>
    </section>




<?php include('layouts/footer.php'); ?>

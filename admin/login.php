<?php

    session_start();


    include('connection.php');
    

    //check if admin is logged in
    if(isset($_SESSION['admin_logged_in'])){
        header("location: index.php");
        exit;
    }

    if(isset($_POST['login_btn'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("select admin_id,admin_name,admin_email,admin_password from admins 
                                        where admin_email=? and admin_password=? limit 1");

        $stmt->bind_param("ss", $email, $password);

        if($stmt->execute()){

            $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
            
            $stmt->store_result();

            if($stmt->num_rows() == 1){
                $stmt->fetch();

                //store admin info in session
                $_SESSION['admin_id'] = $admin_id; 
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_logged_in'] = true;

                //send admin to dashboard
                header("location: index.php?success_message=Welcome Back");
                
            }else{
                header("location: login.php?error_message=invalid email or password, please try again");
            }

        }else{

            header("location: login.php?error_message=something went wrong try again");


        }


    }
    












?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

        <link rel="stylesheet" href="./assets/css/style.css">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>


        <div class="container-fluid w-50 mt-5 mb-5">
            <div class="my-5 text-center">
                <img src="assets/imgs/sabeon.png" alt="" class="w-25">
                <h3 class="mt-3">Admin Dashboard</h3>
            </div>

            <?php include('messages.php'); ?>

            <form method="post" action="login.php">
                <div class="mb-2 form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="mb-2 form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="mb-2 text-center">
                    <input type="submit" value="Login" name="login_btn" id="login_btn" class="btn btn-primary mt-3"> 
                </div>

            </form>
        </div>
    

        




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>
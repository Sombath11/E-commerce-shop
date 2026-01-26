<?php

    include('connection.php');

    if(isset($_GET['product_id'])){

        $product_id = $_GET['product_id'];

        $stmt = $conn->prepare("DELETE from products where product_id=? LIMIT 1");

        $stmt->bind_param("i",$product_id);

        if($stmt->execute()){
            header("Location: products.php?success_message=Product was delete successfully");
        }else{
            header("Location: products.php?error_message=Error, Product delete failed");
        }
    }else{
        header("location: products.php?error_message=no product id was given");
    }




?> 
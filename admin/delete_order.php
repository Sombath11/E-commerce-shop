<?php

    include('connection.php');

    if(isset($_GET['order_id'])){

        $order_id = $_GET['order_id'];

        $stmt = $conn->prepare("DELETE from orders where order_id=? LIMIT 1");

        $stmt->bind_param("i",$order_id);

        if($stmt->execute()){
            header("Location: index.php?success_message=Order was delete successfully");
        }else{
            header("Location: index.php?error_message=Error, Order delete failed");
        }
    }else{
        header("location: index.php?error_message=no Order id was given");
    }




?> 
<?php

    include "connection.php";

    if(isset($_POST['update_order_btn'])) {

        $order_id = $_POST['order_id'];
        $order_cost = $_POST['order_cost'];
        $category = $_POST['category'];
        $date = $_POST['date'];


        $stmt = $conn->prepare("UPDATE orders SET order_status=?
                                WHERE order_id=?, order_cost=? and order_date=? ");

        $stmt->bind_param("siss", $category, $order_id, $order_cost, $date );

        if($stmt->execute()){
            header("Location: index.php?success_message=Order was updated successfully");
        }else{
            header("Location: index.php?error_message=Error, Order update failed");
        }
    }else{

        header("Location: index.php?error=Error, try again");
    }


  
?>
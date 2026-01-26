<?php

    include('connection.php');

    //2.return  number of products
    $stmt1 = $conn->prepare("select count(*) as total_products from products");
    $stmt1->execute();
    $stmt1->bind_result($total_products);
    $stmt1->store_result();
    $stmt1->fetch();


    $stmt2 = $conn->prepare("select count(*) as total_users from users");
    $stmt2->execute();
    $stmt2->bind_result($total_users);
    $stmt2->store_result();
    $stmt2->fetch();


    $stmt3 = $conn->prepare("select sum(product_quantity) as total_quantity from order_items");
    $stmt3->execute();
    $stmt3->bind_result($total_quantity);
    $stmt3->store_result(); 
    $stmt3->fetch();


    $stmt4 = $conn->prepare("select sum(order_cost) as total_money from orders");
    $stmt4->execute();
    $stmt4->bind_result($total_money);
    $stmt4->store_result();
    $stmt4->fetch();













?>
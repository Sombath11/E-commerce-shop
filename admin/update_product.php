<?php

    include "connection.php";

    if(isset($_POST['update_product_btn'])) {

        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $color = $_POST['color'];
        $special_offer = $_POST['special_offer'];
        

        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_category=?, product_color=?, product_special_offer=?  
                                        WHERE product_id=?");

        $stmt->bind_param("ssssssi", $title, $description, $price, $category, $color, $special_offer, $product_id);

        if($stmt->execute()){
            header("Location: products.php?success_message=Product was updated successfully");
        }else{
            header("Location: products.php?error_message=Error, Product update failed");
        }
    }else{

        header("Location: products.php?error=Error, try again");

    }



?>
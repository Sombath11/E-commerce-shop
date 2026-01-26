<?php

    include "connection.php";

    if(isset($_POST['add-product-btn'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $special_offer = $_POST['special_offer'];
        $category = $_POST['category'];
        $color = $_POST['color'];
 
        // this is the file itself (image)
        $image1 = $_FILES['image1']['tmp_name'];
        $image2 = $_FILES['image2']['tmp_name'];
        $image3 = $_FILES['image3']['tmp_name'];
        $image4 = $_FILES['image4']['tmp_name'];
        // $file_name = $_FILES['image1']['name'];

        //image names
        $image_name1 = $title . "1.jpeg";
        $image_name2 = $title . "2.jpeg";
        $image_name3 = $title . "3.jpeg";
        $image_name4 = $title . "4.jpeg";

        //upload image
        move_uploaded_file($image1, "../assets/imgs/".$image_name1);
        move_uploaded_file($image2, "../assets/imgs/".$image_name2);
        move_uploaded_file($image3, "../assets/imgs/".$image_name3);
        move_uploaded_file($image4, "../assets/imgs/".$image_name4);


        // create a new product
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_special_offer,
                                                            product_image,product_image2,product_image3,product_image4 ,
                                                            product_category, product_color) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssss", $title, $description, $price, $special_offer, 
                                            $image_name1,$image_name2,$image_name3,$image_name4,
                                            $category, $color);

        if($stmt->execute()){

            header("Location: products.php?success_message=Product was created successfully");

        }else{
            header("Location: products.php?error_message=Error, Product creation failed");
        }


    }else{

        header("Location: products.php?error=Error, try again");

    }







 





?>
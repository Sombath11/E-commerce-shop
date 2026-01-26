<?php

// After successful capture


if ($httpcode == 201 && $response_data['status'] == 'COMPLETED') {
    // Get transaction details
    $transaction_id = $response_data['purchase_units'][0]['payments']['captures'][0]['id'];
    
    // Update your orders table
    include('../server/connection.php'); // Adjust path to your connection file
    
    if(isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];
        
        $stmt = $conn->prepare("UPDATE orders SET order_status = 'paid', payment_date = NOW(), transaction_id = ? WHERE order_id = ?");
        $stmt->bind_param("si", $transaction_id, $order_id);
        $stmt->execute();
        $stmt->close();
    }
    
    // Clear cart session
    unset($_SESSION['total']);
    unset($_SESSION['cart']);
}


?>
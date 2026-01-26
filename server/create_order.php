<?php
header('Content-Type: application/json');
session_start();

// Get the amount from session or POST
$amount = isset($_SESSION['total']) ? $_SESSION['total'] : 
          (isset($_POST['order_total_price']) ? $_POST['order_total_price'] : 0);

if ($amount == 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

// PayPal API credentials
$client_id = 'Ad7gnzWigH65tgpF6Y7KDUBkKVXVY3vk-oRDEcIu_VlVrOjd02AfzbYcDD7IS06GhTaikkIEDz7_-yff';
$client_secret = 'EPwVH00NK_b7K9moXSGeA_-YzPlmmcducpCYpBeGsdvGhzPY0cjYKtF5fAc8huTQp2tqJmffPdS_msbE';
$paypal_url = 'https://api-m.sandbox.paypal.com'; // Use https://api-m.paypal.com for production

// Get access token
function getAccessToken($client_id, $client_secret, $paypal_url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $paypal_url . '/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpcode != 200) {
        return false;
    }
    
    $data = json_decode($response, true);
    return $data['access_token'] ?? false;
}

// Create PayPal order
$access_token = getAccessToken($client_id, $client_secret, $paypal_url);

if (!$access_token) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to authenticate with PayPal']);
    exit;
}

// Prepare order data
$order_data = [
    'intent' => 'CAPTURE',
    'purchase_units' => [
        [
            'amount' => [
                'currency_code' => 'USD',
                'value' => number_format($amount, 2, '.', '')
            ]
        ]
    ]
];

// Create order via PayPal API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypal_url . '/v2/checkout/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpcode != 201) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create order', 'details' => json_decode($response, true)]);
    exit;
}

echo $response;
?>
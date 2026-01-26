const paypalButtons = window.paypal.Buttons({
    style: {
        shape: "rect",
        layout: "vertical",
        color: "gold",
        label: "paypal",
    },
   
    async createOrder() {
        try {
            const response = await fetch("server/create_order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                }
            });

            const orderData = await response.json();

            if (orderData.id) {
                return orderData.id;
            }
            
            const errorDetail = orderData?.details?.[0];
            const errorMessage = errorDetail
                ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                : JSON.stringify(orderData);

            throw new Error(errorMessage);
        } catch (error) {
            console.error(error);
            resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
        }
    },
    
    async onApprove(data, actions) {
        try {
            const response = await fetch("server/capture_order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
            });

            const orderData = await response.json();
            
            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you message

            const errorDetail = orderData?.details?.[0];

            if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                return actions.restart();
            } else if (errorDetail) {
                // (2) Other non-recoverable errors -> Show a failure message
                throw new Error(
                    `${errorDetail.description} (${orderData.debug_id})`
                );
            } else if (!orderData.purchase_units) {
                throw new Error(JSON.stringify(orderData));
            } else {
                // (3) Successful transaction -> Show confirmation or thank you message
                const transaction =
                    orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
                    orderData?.purchase_units?.[0]?.payments?.authorizations?.[0];
                    
                resultMessage(
                    `Transaction ${transaction.status}: ${transaction.id}<br><br>
                    Your payment has been processed successfully!<br>
                    <a href="account.php" class="btn btn-primary mt-3">View Orders</a>
                    
                    window.location.href = 'server/complete_payment.php?transaction_id=' + transaction.id+'&order_id=' + <?php echo $order_id;?> ;

                    `

                    

                );
                
                console.log(
                    "Capture result",
                    orderData,
                    JSON.stringify(orderData, null, 2)
                );
            }
        } catch (error) {
            console.error(error);
            resultMessage(
                `Sorry, your transaction could not be processed...<br><br>${error}`
            );
        }
    },
    
    onError(err) {
        console.error('PayPal Buttons error:', err);
        resultMessage(`An error occurred during payment processing. Please try again.`);
    }
});

paypalButtons.render("#paypal-button-container");

// Example function to show a result to the user
function resultMessage(message) {
    const container = document.querySelector("#result-message");
    container.innerHTML = message;
}
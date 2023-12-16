<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('location: index.php?page=placeorder');
    exit;


    // Validate username and password criteria
    // $errors = [];
    
    // // If no errors, insert into database and redirect to login page
    // if (empty($errors)) {
         //$stmt = $pdo->prepare('Insert Into credit_card_info (user_id, num, cvv) values ('$user', '$card', '$cvc')');
         //$stmt->execute();
    // } else {
    //     // Display errors if criteria not met
    //     foreach ($errors as $error) {
    //         echo '<div class = "error-message"> Error: ' . $error . "</div><br>";
    //     }
    // }
}
?>


<?=template_header('Checkout')?>
<body>
<div class = "checkout">
<h1>Please enter your info</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for = "shipping address">Shipping Address:</label><br>
        <label for="street_num">Street Number:</label><br>
        <input type="text" id="street_number" name="street_number"><br>
        <label for="street_name">Street Name:</label><br>
        <input type="text" id="street_name" name="street_name"><br>
        <label for="city">City:</label><br>
        <input type="text" id="city" name="city"><br>
        <label for="state">State:</label><br>
        <input type="text" id="state" name="state"><br>
        <label for="zip">Zip Code:</label><br>
        <input type="text" id="zip" name="zip"><br><br>

        <label for = "Payment Info">Payment Info:</label><br>
        <label for = "credit card">Credit Card Number:</label><br>
        <input type = "text" id = "card" name = "card"><br>
        <label for = "credit card">CVC:</label><br>
        <input type = "text" id = "card_cvc" name = "card_cvc"><br>
        <input type="submit" value="Place Order">
    </form>
</div>
</body>
<?=template_footer()?>
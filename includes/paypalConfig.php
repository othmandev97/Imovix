<?php 
require_once("PayPal-PHP-SDK/autoload.php");

// Step 1
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        '*********************************************',     // ClientID
        '*********************************************'      // ClientSecret
    )
);


?>
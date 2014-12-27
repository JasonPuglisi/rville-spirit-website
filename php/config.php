<?php
// Database connection details
$DATABASE_TYPE = 'mysql';
$DATABASE_HOST = 'localhost';
$DATABASE_NAME = 'DATABASE';
$USER_NAME = 'USERNAME';
$USER_PASSWORD = 'PASSWORD';

// Delivery messages
$DELIVERY_MESSAGE['shipping_and_pickup'] = 'This product is available for shipping and pickup. Orders are processed as soon as possible, and you will be notified when your order has been shipped or is ready for pickup.';
$DELIVERY_MESSAGE['shipping'] = 'This product is available for shipping only. Orders are processed as soon as possible, and you will be notified when your oder has been shipped.';
$DELIVERY_MESSAGE['pickup'] = 'This product is available for pickup only. Orders are processed as soon as possible, and you will be notified when your order is ready for pickup.';

// Error messages
$ERROR_MESSAGE['invalid_product'] = 'This product isn\'t available. Make sure your link is correct, and <a href=\'/\'>return to the home page</a> if this problem persists.';

// EOF: config.php

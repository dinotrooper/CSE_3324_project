<?php
require_once 'test_database_functions.php';

$connection = connectToLocalDatabase();

echo("Deleting any rows that may be in the database. <br>");
deleteAllDataFromTables($connection);

$shippingName = 'dinotrooper';
$shippingStreetOne = '123 Fire Rd';
$shippingStreetTwo = '';
$shippingCity = 'Starkville';
$shippingState = 'MS';
$shippingZip = 98765;
$orderDate = '2018-04-20 10:08:45';
$orderTotal = 208.98;
$cartTotal = 17.98;
$allTestPassed = 1;

$dino_userID = createUser($connection, 'dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1);
$wrekk_userID = createUser($connection, 'wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1);
$lee_userID = createUser($connection, 'lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);

$dino_orderID = createOrder($connection,'dinotrooper', $dino_userID, '123 Fire Rd', 'Starkville', 'MS', 98765, '2018-04-20 10:08:45');
$dino_cartID = createCart($connection, 'dinotrooper', $dino_userID);

$dino_itemID = createItem($connection, 'dinotrooper', $dino_userID, 'tshirt_image', 'Dino Shirt', 'a dino tshirt', 1, 'clothing', 4.99);
$wrek_itemID = createItem($connection, 'wrekker', $wrekk_userID, 'basketball_image', 'Kool Basketball', 'A really cool basketball', 1, 'sports', 8.99);
$lee_itemID = createItem($connection, 'lee', $lee_userID, 'textbook_image', 'Calculus Textbook', 'Textbook I used from Cal 1 to Cal IV', 1, 'media', 199.99);

createOrderItem($connection, $dino_orderID, $wrek_itemID, $dino_userID, 1);
createOrderItem($connection, $dino_orderID, $lee_itemID, $dino_userID, 1);

createCartItem($connection, $dino_cartID, $wrek_itemID, $dino_userID, 2, $cartTotal);

echo("Finished creating table test data. :D <br>");
echo("Testing order.php. <br>");

require_once 'order.php';

//create a existing order object
echo('Creating a local instance of an order using static function existingOrder called $dino_order. <br>');
$dino_order = Order::existingOrder($dino_orderID);

//checking order object
echo('Checking all class members of $dino_order. <br>');

if (testOrder($dino_order, $dino_orderID, $shippingName, $shippingStreetOne, $shippingStreetTwo, 
    $shippingCity, $shippingState, $shippingZip, $orderDate, $orderTotal, $wrek_itemID, $lee_itemID, 1))
        echo('All tests for $dino_order passed! <br>');
    else echo('One or more tests failed for $dino_order! <br>');

//create a new order object
echo('Creating a local instance of an order using static function newOrder called $dino_order_two. <br>');
$dino_order_two = Order::newOrder($dino_userID, $dino_cartID, 'dinotrooper', '123 Fire Rd', '', 'Starkville', 'MS', 98765);

//checking order object
echo('Checking all class members of $dino_order_two. <br>');
if (testOrder($dino_order_two, $dino_orderID + 1, $shippingName, $shippingStreetOne, $shippingStreetTwo,
    $shippingCity, $shippingState, $shippingZip, $orderDate, $cartTotal, $wrek_itemID, $lee_itemID, 2))
        echo('All tests for $dino_order_two passed! <br>');
    else echo('One or more tests failed for $dino_order_two! <br>');
    
//delete the new order object    
echo('Deleting local instance of $dino_order_two and associated data in database using $dino_userID. <br>');
$dino_order_two->deleteOrder($dino_userID);

echo('Checking all class members of $dino_order_two. <br>');

if (testDeletedOrder($dino_order_two)) echo('All tests for deleting $dino_order_two passed! <br>');
else echo('One or more tests failed for deleting $dino_order_two! <br>');

//recreate the item in the cart since creating a order deletes the items in cart
createCartItem($connection, $dino_cartID, $wrek_itemID, $dino_userID, 2, $cartTotal);

//recreate a new order object
echo('Creating a local instance of an order using static function newOrder called $dino_order_three. <br>');
echo('$dino_order_three is an exact copy of $dino_order_two. <br>');
$dino_order_three = Order::newOrder($dino_userID, $dino_cartID, 'dinotrooper', '123 Fire Rd', '', 'Starkville', 'MS', 98765);

echo('Checking all class members of $dino_order_three. <br>');
if (testOrder($dino_order_three, $dino_orderID + 2, $shippingName, $shippingStreetOne, $shippingStreetTwo,
    $shippingCity, $shippingState, $shippingZip, $orderDate, $cartTotal, $wrek_itemID, $lee_itemID, 2))
    echo('All tests for $dino_order_three passed! <br>');
    else echo('One or more tests failed for $dino_order_three! <br>');

//delete the new order object using an admin account    
echo('Deleting local instance of $dino_order_three and associated data in database using $wrek_userID. <br>');
$dino_order_three->deleteOrder($wrekk_userID);

echo('Checking all class members of $dino_order_three. <br>');
if (testDeletedOrder($dino_order_three)) echo('All tests for deleting $dino_order_three passed! <br>');
else echo('One or more tests failed for deleting $dino_order_three! <br>');

//recreate the new order object and item in cart
createCartItem($connection, $dino_cartID, $wrek_itemID, $dino_userID, 2, $cartTotal);

echo('Creating a local instance of an order using static function newOrder called $dino_order_four. <br>');
echo('$dino_order_four is an exact copy of $dino_order_two. <br>');
$dino_order_four = Order::newOrder($dino_userID, $dino_cartID, 'dinotrooper', '123 Fire Rd', '', 'Starkville', 'MS', 98765);

echo('Checking all class members of $dino_order_four. <br>');
if (testOrder($dino_order_four, $dino_orderID + 3, $shippingName, $shippingStreetOne, $shippingStreetTwo,
    $shippingCity, $shippingState, $shippingZip, $orderDate, $cartTotal, $wrek_itemID, $lee_itemID, 2))
    echo('All tests for $dino_order_four passed! <br>');
    else echo('One or more tests failed for $dino_order_four! <br>');
    
echo('Deleting local instance of $dino_order_four and associated data in database using $lee_userID. <br>');
echo('Deletion should fail since $lee_userID is not an userID of an admin account and it is not the account of the order owner <br>');
$dino_order_three->deleteOrder($lee_userID);
    
if (testOrder($dino_order_four, $dino_orderID + 3, $shippingName, $shippingStreetOne, $shippingStreetTwo,
    $shippingCity, $shippingState, $shippingZip, $orderDate, $cartTotal, $wrek_itemID, $lee_itemID, 2))
    echo('All tests for $dino_order_four passed! <br>');
    else echo('One or more tests failed for $dino_order_four! <br>');


function testOrder($order, $id, $name, $streetOne, $streetTwo, $city, $state, $zip, $date, $total, $itemOne, $itemTwo, $quantity) {
    $allTestPassed = 1;
    
    if (!testValues($id, $order->getOrderID())) {echo("OrderID check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($name, $order->getShippingName())) {echo("ShippingName check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($streetOne, $order->getShippingStreetOne())) {echo("ShippingStreetOne check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($streetTwo, $order->getShippingStreetTwo())) {echo("ShippingStreetTwo check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($city, $order->getShippingCity())) {echo("ShippingCity check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($state, $order->getShippingState())) {echo("ShippingState check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($zip, $order->getShippingZip())) {echo("ShippingZip check failed. <br>"); $allTestPassed = 0;}
    if (!$order->getOrderDate()) {echo("OrderDate check failed. <br>"); $allTestPassed = 0;}
    if (!testValues($total, $order->getOrderTotal())) {echo("OrderTotal check failed. <br>"); $allTestPassed = 0;}
    foreach ($order->getItemsInOrder() as $itemID => $itemQuantity) {
        if (!testValues($itemID, $itemOne) AND !testValues($itemID, $itemTwo)) {echo("ItemID check failed. <br>"); $allTestPassed = 0;}
        if (!testValues($itemQuantity, $quantity)) {echo("ItemQuantity check failed. <br>"); $allTestPassed = 0;}
    }
    
    return $allTestPassed;
}

function testDeletedOrder($order) {
    $allTestPassed = 1;
    
    if ($order->getOrderID()) {echo("OrderID check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingName()) {echo("ShippingName check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingStreetOne()) {echo("ShippingStreetOne check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingStreetTwo()) {echo("ShipingStreetTwo check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingCity()) {echo("ShippingCity check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingState()) {echo("ShippingState check failed. <br>"); $allTestPassed = 0;}
    if ($order->getShippingZip()) {echo("ShippingZip check failed. <br>"); $allTestPassed = 0;}
    if ($order->getOrderDate()) {echo("OrderDate check failed. <br>"); $allTestPassed = 0;}
    if ($order->getOrderTotal()) {echo("OrderTotal check failed. <br>"); $allTestPassed = 0;}
    if ($order->getItemsInOrder()) {echo("ItemsInOrder check failed. <br>"); $allTestPassed = 0;}
    
    return $allTestPassed;
}
?>
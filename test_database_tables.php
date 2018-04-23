<?php

require_once 'test_database_functions.php';
require_once 'login.php';

$conn = new mysqli ('localhost','root', '', '');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>");
die();}
deleteDB();

$connection = new mysqli('localhost', 'root', '', 'group7_project_database');
if ($connection->connect_error) {
    echo("Connection to database failed. <br>");
    die();
}
else echo("Succesfully connected to mySQL server and group7_project_database. <br>");


echo("Deleting any rows that may be in the database.");
deleteAllDataFromTables($connection);

$dino_userID = createUser($connection, 'dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1); 
$wrekk_userID = createUser($connection, 'wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1);
$lee_userID = createUser($connection, 'lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);

$dino_orderID = createOrder($connection,'dinotrooper', $dino_userID, '123 Fire Rd', 'Starkville', 'MS', 98765, '2018-04-20 10:08:45');
$wrek_orderID = createOrder($connection, 'wrekker', $wrekk_userID, '123 Water Rd', 'Memphis', 'TN', 65478, '2016-08-15 09:07:23');
$lee_orderID = createOrder($connection, 'lee', $lee_userID, '123 Grass Rd', 'Huntsville', 'AL', 45218, '2013-06-08 11:11:11');

$dino_itemID = createItem($connection, 'dinotrooper', $dino_userID, 'tshirt_image', 'Dino Shirt', 'a dino tshirt', 1, 'clothing', 4.99);
$wrek_itemID = createItem($connection, 'wrekker', $wrekk_userID, 'basketball_image', 'Kool Basketball', 'A really cool basketball', 1, 'sports', 8.99);
$lee_itemID = createItem($connection, 'lee', $lee_userID, 'textbook_image', 'Calculus Textbook', 'Textbook I used from Cal 1 to Cal IV', 1, 'Media', 199.99);

$dino_cartID = createCart($connection, 'dinotrooper', $dino_userID);
$wrek_cartID = createCart($connection, 'wrekker', $wrekk_userID);
$lee_cartID = createCart($connection, 'lee', $lee_userID);

createOrderItem($connection, $dino_orderID, $wrek_itemID, $dino_userID, 1);
createOrderItem($connection, $dino_orderID, $lee_itemID, $dino_userID, 1);

createOrderItem($connection, $wrek_orderID, $dino_itemID, $wrekk_userID, 1);
createOrderItem($connection, $wrek_orderID, $lee_itemID, $wrekk_userID, 1);

createOrderItem($connection, $lee_orderID, $dino_itemID, $lee_userID, 1);
createOrderItem($connection, $lee_orderID, $wrek_itemID, $lee_userID, 1);

createCartItem($connection, $dino_cartID, $wrek_itemID, $dino_userID, 1, 8.99);
createCartItem($connection, $dino_cartID, $lee_itemID, $dino_userID, 1, 199.99);

createCartItem($connection, $wrek_cartID, $dino_itemID, $wrekk_userID, 1, 4.99);
createCartItem($connection, $wrek_cartID, $lee_itemID, $wrekk_userID, 1, 199.99);

createCartItem($connection, $lee_cartID, $dino_itemID, $lee_userID, 1, 4.99);
createCartItem($connection, $lee_cartID, $wrek_itemID, $lee_userID, 1, 8.99);

$dino_ratingID = createItemRating($connection, $wrek_itemID, $dino_userID, 1);
$wrek_ratingID = createItemRating($connection, $lee_itemID, $wrekk_userID, 4);
$lee_ratingID = createItemRating($connection, $dino_itemID, $lee_userID, 2);

$dino_commentID = createItemComment($connection, $wrek_itemID, $dino_userID, 'The ball had a hole in it! Unacceptable!');
$wrek_commentID = createItemComment($connection, $lee_itemID, $wrekk_userID, 'The book is in great condition besides some highlighting and notes made in the margin.');
$lee_commentID = createItemComment($connection, $dino_itemID, $lee_userID, 'I love the graphic on the shirt, but it is not the size I wanted.');
echo("Finished creating table test data. :D <br>");
echo("Testing order.php. <br>");

require_once 'order.php';
$dino_order = Order::ExistingOrder($dino_orderID);
//either delete shippingName class member or add field to order table
echo($dino_order->getShippingName()."<br>");
echo($dino_order->getShippingStreetOne()."<br>");
echo($dino_order->getShippingStreetTwo()."<br");
//TODO: figure out why getShippingCity isn't returning the shippingCity in the database
echo($dino_order->getShippingCity()."<br>");
echo($dino_order->getShippingState()."<br>");
echo($dino_order->getShippingZip()."<br>");
echo($dino_order->getOrderDate()."<br>");
echo($dino_order->getOrderTotal()."<br>");

//TODO: test all the other functions of the backend classes
//$dino_order_two = Order::NewOrder($dino_userID, $dino_cartID, $orderTotal, $shippingName, $shippingStreetOne, $shippingStreetTwo, $shippingCity, $shippingState, $shippingZip)

?>
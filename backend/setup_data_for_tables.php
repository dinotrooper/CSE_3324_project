<?php
require_once 'setup_test_databases.php';

$connection = connectToLocalDatabase();

echo("Deleting any rows that may be in the database. <br>");
deleteAllDataFromTables($connection);

$item_image = 'tshirt_image';
$item_name = 'Dino Shirt';
$item_desc = 'a dino tshirt';
$item_quantity = 1;
$item_category = 'clothing';
$item_price = 4.99;

$item_image_two = 'tshirt_image2';
$item_name_two = 'A T-rex-shirt';
$item_desc_two = 'A t-rex shirt. lol.';
$item_quantity_two = 2;
$item_category_two = 'Clothing and Apparel';
$item_price_two = 7.99;

$dino_userID = createUser($connection, 'dinotrooper', 'alexward', 'dino@gmail.com', '123 Fire Rd', 'Starkville', 'MS', 98765, 12345678, '3/3000', 134, 1);
$wrekk_userID = createUser($connection, 'wrekker', 'wardalex', 'wrekker@gmail.com', '123 Water Rd', 'Memphis', 'TN', 65478, 98765432, '8/2045', 753, 1);
$lee_userID = createUser($connection, 'lee-thegreat', 'wardlee', 'greatlee@gmail.com', '123 Grass Rd', 'Huntsville', 'AL', 45218, 12378965, '4/2075', 367, 0);
$steven_userID = createUser($connection, 'steven', 'magicthegather', 'mtgjudge@gmail.com', '123 Rock Rd', 'Southaven', 'MS', 38657, 9854781, '6/2036', 746, 0);

$dino_orderID = createOrder($connection,'dinotrooper', $dino_userID, '123 Fire Rd', 'Starkville', 'MS', 98765, '2018-04-20 10:08:45',208.98);
$wrek_orderID = createOrder($connection, 'wrekker', $wrekk_userID, '123 Water Rd', 'Memphis', 'TN', 65478, '2016-08-15 09:07:23', 204.98);
$lee_orderID = createOrder($connection, 'lee', $lee_userID, '123 Grass Rd', 'Huntsville', 'AL', 45218, '2013-06-08 11:11:11', 13.98);

$dino_itemID = createItem($connection, 'dinotrooper', $dino_userID, $item_image, $item_name, $item_desc, $item_quantity, $item_category, $item_price);
$wrek_itemID = createItem($connection, 'wrekker', $wrekk_userID, 'basketball_image', 'Kool Basketball', 'A really cool basketball', 1, 'sports', 8.99);
$lee_itemID = createItem($connection, 'lee', $lee_userID, 'textbook_image', 'Calculus Textbook', 'Textbook I used from Cal 1 to Cal IV', 1, 'Media', 199.99);

$dino_cartID = createCart($connection, 'dinotrooper', $dino_userID);
$wrek_cartID = createCart($connection, 'wrekker', $wrekk_userID);
$lee_cartID = createCart($connection, 'lee', $lee_userID);

createOrderItem($connection, $dino_orderID, 'Kool Basketball', $dino_userID, 1, 8.99);
createOrderItem($connection, $dino_orderID, 'Calculus Textbook', $dino_userID, 1, 199.99);

createOrderItem($connection, $wrek_orderID, $item_name, $wrekk_userID, 1, $item_price);
createOrderItem($connection, $wrek_orderID, 'Calculus Textbook', $wrekk_userID, 1, 199.99);

createOrderItem($connection, $lee_orderID, $item_name, $lee_userID, 1, $item_price);
createOrderItem($connection, $lee_orderID, 'Kool Basketball', $lee_userID, 1, 8.99);

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
$lee_comment_two = 'He saw my comment and sent me a shirt in my size FOR FREE! I am so pumped! Thanks man!';

echo("Finished creating table test data. :D <br><br><br>");


?>